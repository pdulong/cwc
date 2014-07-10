<?php

class OrderController extends BaseController{

	public function __construct(){
		$loggedIn = Auth::check();

		//Session::flash('message', 'test');

		//echo ($loggedIn?'yes':'no');
	}

	public function getBuy( $id = null ){

		$products = Product::all();

		foreach( Country::get(array('id','countrySlug')) as $country )
			$countries[$country -> id] = trans('interface.countryName_'.$country -> countrySlug);

		$data = array(
			'products' 		=> $products,
			'productActive' => $id,
			'countries' 	=> $countries
		);

		return View::make('ordersBuy', $data);
	}

	private function saveAsPaid( $orderRandomString = false ){

		$order = Order::where('random_string','=',$orderRandomString)->first();
		$order->paid 			= 1;
		$order->payment->paid 	= 1;

		$order->save();
		$order->payment->save();

		$product = Product::find($order->product_id);

		$emailData = array(
			'order' => array(
				'nameSlug' 	=> $product->nameSlug,
				'hash'		=> $product->hash,
				'randomString' => $orderRandomString
			)
		);

		$user = $order->user;

		Mail::queue('emails.complete_order', $emailData, function($message) use ($user){
			$message->to($user->email, $user->firstname . ' ' . $user->lastname)
				->subject('['.trans('interface.companyName').'] ' . trans('interface.email_orderComplete'));
		});

		return true;
	}

	public function getAffiliate( $affiliate = false ){
		Session::put('affiliate', $affiliate);
		setcookie('affiliate', $affiliate);

		return Redirect::to('products');
	}

	public function complete( $orderRandomString = false ){

		$order = Order::where('random_string','=',$orderRandomString)->first();

		if(strlen($order->user->affiliate)==0)
		{
			$order->user->affiliate = uniqid($order->user->id);
			$order->user->save();
		}

		if( $order->payment->paid == 0){
			return Redirect::to('pay/'.$orderRandomString)->with('errorMessage', trans('interface.order_completePayment'));
		}

		$output = array(
			'url' => action('OrderController@getAffiliate', array('affiliate' => $order->user->affiliate))
		);

		return View::make('complete', $output);
	}

	public function pay( $orderRandomString = false ){

		$order = Order::where('random_string','=',$orderRandomString)->first();

		if( $order->payment->paid == 1){
			return Redirect::to('complete/'.$orderRandomString)->with('successMessage', trans('interface.form_alreadyPaid'));
		}

		//Make new payment
		if( $order->payment->method == 'ideal' )
		{
			//!todo: check if currency is EUR
			try{

				//Mollie IDeal
				$mollie = new Mollie_API_Client;
				$mollie->setApiKey("test_4OZ2HowIV4E0SsDD0bAHLSMWTEI2tO");

				//Check if order is paid - user is redirected
				if( !$order->payment->paid && strlen($order->payment->trx_id) )
				{
					$payment = $mollie->payments->get($order->payment->trx_id);

					if ($payment->isPaid() == TRUE){
						$this->saveAsPaid($orderRandomString);
						return Redirect::to('complete/' . $orderRandomString);
					}else{
						$url = $payment->getPaymentUrl();

						//Refresh and create new payment
						$order->payment->trx_id = '';
						$order->payment->save();

						return Redirect::to('pay/' . $orderRandomString )->with('errorMessage', trans('interface.form_orderRetry') . ' <a href="'.$url.'">Click here to pay</a>');
					}

				}else{



				$payment = $mollie->payments->create(array(
					"amount"       => ($order->payment->amount/100),
					"description"  => 'CryptoWaveCapital MC Purchase: ' . $orderRandomString,
					"redirectUrl"  => URL::to('pay/' . $orderRandomString),
					"metadata"     => array(
						"order_id" => $order->id,
					),
				));

				$order->payment->trx_id = $payment->id;
				$order->payment->save();

				$url = $payment->getPaymentUrl();

				return Redirect::away($url);
				echo '<a href="'.$url.'">Pay</a>';
				}

			}
			catch (Mollie_API_Exception $e)
			{
				return View::make('pay')->with('alertMessage', 'API call failed: ' . htmlspecialchars($e->getMessage()));
			}

		}elseif( $order->payment->method == 'creditcard'){
			//Stripe

			$data = array(
				'amount' 	=> $order->payment->amount,
				'currency'	=> $order->payment->currency,
				'randomString' => $orderRandomString
			);

			return View::make('creditcard', $data);

		}
	}

	public function stripe_save( $orderRandomString = false ){

		$order = Order::where('random_string','=',$orderRandomString)->first();

		if( $order->payment->paid == 1){
			return Redirect::to('complete/'.$orderRandomString)->with('message','Order is already paid');
		}

		Stripe::setApiKey(Config::get('stripe.stripe.secret'));

		$token = Input::get('stripeToken');

		try {
			$charge = Stripe_Charge::create(array(
				'amount' 		=> $order->payment->amount,
				'currency'		=> $order->payment->currency,
				'card'  		=> $token,
				'description' 	=> 'Charge for my product')
			);

		} catch(Stripe_CardError $e) {
			$e_json = $e->getJsonBody();
			$error = $e_json['error'];

			return Redirect::to('pay/'.$orderRandomString)
			  ->withInput()->with('stripe_errors',$error['message']);
		}

		$this->saveAsPaid($orderRandomString);

		return Redirect::to('complete/'.$orderRandomString);
	}

	public function postBuy( $id = false ){

		if( !Auth::check() ){

			$validator = Validator::make(Input::all(), User::$rulesRegistration);

			if( $validator -> passes() )
			{

				//Create a new user
				$user = new User;

			    $user->firstname  = Input::get('firstname');
			    $user->lastname   = Input::get('lastname');
			    $user->email      = Input::get('email');
			    $user->password   = Hash::make(Input::get('password'));
			    $user->address    = Input::get('address');
			    $user->postal     = Input::get('postal');
			    $user->country_id = Input::get('country');


			    $user->save();

			    $user->affiliate  = uniqid($user->id);
			    $user->save();

			    //Login new user
			    $login = Auth::loginUsingId($user->id, true);

			    $userId = $user->id;

			}else{
				return Redirect::to('orders/buy/'.$id)->with('alertMessage', trans('interface.form_errorsFound'))->withErrors($validator)->withInput();
			}
		}else $userId = Auth::id();

		//echo '<pre>'; print_r(Auth::user()); echo '</pre>';exit;

		$validator = Validator::make(Input::all(), Order::$rulesNewOrder);

		if( $validator -> passes() )
		{
			//Save order

			$order = new Order;

			$order->user_id     = $userId;
			$order->product_id  = Input::get('product');
			$order->amount      = Input::get('amount');
			$order->random_string = str_random(32);

			//Save affiliate
			$aff1 = Session::get('affiliate', false);
			$aff2 = Cookie::get('affiliate');

			if( strlen($aff1) || strlen($aff2) )
			{
				$aff = (strlen($aff1)?$aff1:$aff2);

				$userAffiliated = User::where('affiliate', $aff)->first();

				if( isset($userAffiliated->id) )
				{
					$order->affiliate = $userAffiliated->id;

					$emailData = array(
						'firstname' => Auth::user()->firstname,
						'lastname' => Auth::user()->lastname,
					);

					Mail::queue('emails.new_affiliate', $emailData, function($message) use ($userAffiliated){
						$message->to($userAffiliated->email, $userAffiliated->firstname . ' ' . $userAffiliated->lastname)
							->subject('['.trans('interface.companyName').'] ' . trans('interface.email_newRefSub'));
					});


				}
			}

			$order->save();

			//Get country currency
			$country = Country::find(Auth::user()->country_id);

			//Get product
			$product = Product::find($order->product_id);

			$priceTotal = round($product->price_per_hash * $product->hash * $country->currency_multiplier * $order->amount);

			//Create payment
			$payment = new Payment;

			$payment->order_id 	= $order->id;
			$payment->amount 	= $priceTotal;
			$payment->method 	= Input::get('payment');
			$payment->currency 	= $country->currency;

			$payment->save();

			$redirectString = $order->random_string;

			$emailData = array(
				'order' => array(
					'nameSlug' 		=> $product->nameSlug,
					'orderAmount'	=> $order->amount,
					'randomString'	=> $order->random_string,
					'hash'			=> $product->hash,
					'price'			=> $product->price_per_hash,
					'currency'		=> $payment->currency,
					'priceTotal' 	=> $priceTotal,
				),
				'paymentLink' => 'http://www.mining-certificates.com/pay/' . $redirectString
			);

			Mail::queue('emails.new_order', $emailData, function($message){
				$message->to(Auth::user()->email, Auth::user()->firstname . ' ' . Auth::user()->lastname)
					->subject('['.trans('interface.companyName').'] ' . trans('interface.email_orderPlaceSubject'));
			});

		    return Redirect::to('pay/' . $redirectString )->with('successMessage', trans('interface.form_orderSuccess'));

		}else{
			return Redirect::to('orders/buy/'.$id)->with('alertMessage', trans('interface.form_errorsFound'))->withErrors($validator)->withInput();
		}
	}


}