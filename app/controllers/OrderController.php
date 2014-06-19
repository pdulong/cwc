<?php

class OrderController extends BaseController{

	public function __construct(){
		$loggedIn = Auth::check();

		//Session::flash('message', 'test');

		//echo ($loggedIn?'yes':'no');
	}

	public function getBuy( $id = null ){

		foreach( Product::get(array('id','nameSlug')) as $product )
			$products[$product -> id] = trans('interface.productName_'.$product -> nameSlug);

		foreach( Country::get(array('id','countrySlug')) as $country )
			$countries[$country -> id] = trans('interface.countryName_'.$country -> countrySlug);

		$data = array(
			'products' 		=> $products,
			'productActive' => $id,
			'countries' 	=> $countries
		);

		return View::make('ordersBuy', $data);
	}

	public function pay( $orderRandomString = false ){

		$order = Order::where('random_string','=',$orderRandomString)->first();

		if( $order->payment->paid ){
			Redirect::to('complete/'.$orderRandomString)->with('message','Order is already paid');
		}

		//Check if order is paid - user is redirected
		if( !$order->payment->paid && strlen($order->payment->trx_id) )
		{
			//!todo: check payment and redirect
			$payment = $mollie->payments->get($order->payment->trx_id);

			echo '<pre>'; print_r($payment); echo '</pre>';
			return false;
		}

		//Make new payment
		if( $order->payment->method == 'ideal' )
		{
			//!todo: check if currency is EUR

			try{

				//Mollie IDeal

				$mollie = new Mollie_API_Client;
				$mollie->setApiKey("test_4OZ2HowIV4E0SsDD0bAHLSMWTEI2tO");

				/*
				* Determine the url parts to these example files.
				*/
				//$protocol = isset($_SERVER['HTTPS']) && strcasecmp('off', $_SERVER['HTTPS']) !== 0 ? "https" : "http";
				//$hostname = $_SERVER['HTTP_HOST'];
				//$path     = dirname(isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : $_SERVER['PHP_SELF']);

				/*
				* Payment parameters:
				*   amount        Amount in EUROs. This example creates a € 10,- payment.
				*   description   Description of the payment.
				*   redirectUrl   Redirect location. The customer will be redirected there after the payment.
				*   metadata      Custom metadata that is stored with the payment.
				*/
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

				echo '<a href="'.$url.'">Pay</a>';

				//echo 'test';
				//Redirect::away($url);
			}
			catch (Mollie_API_Exception $e)
			{
				return Response::make("API call failed: " . htmlspecialchars($e->getMessage()));
			}

		}elseif( $order->payment->method == 'creditcard'){
			//Stripe
		}

		//echo '<pre>'; print_r($payment); echo '</pre>';

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

			    //Login new user
			    $login = Auth::attempt(array(
					'email' => Input::get('email'),
					'password' => Hash::make(Input::get('password'))
			    ), true);

			    $userId = $user->id;

			}else{
				return Redirect::to('orders/buy/'.$id)->with('message', 'The following errors occurred')->withErrors($validator)->withInput();
			}
		}else $userId = Auth::id();

		$validator = Validator::make(Input::all(), Order::$rulesNewOrder);

		if( $validator -> passes() )
		{
			$order = new Order;

			$order->user_id     = $userId;
			$order->product_id  = Input::get('product');
			$order->amount      = Input::get('amount');
			$order->random_string = str_random(32);

			$order->save();

			//Get country currency
			$country = Country::find(Auth::user()->country_id);

			//Get product
			$product = Product::find($order->product_id);

			$priceTotal = round($product->price * $country->currency_multiplier);

			//Create payment
			$payment = new Payment;

			$payment->order_id 	= $order->id;
			$payment->amount 	= $order->amount * $product->price;
			$payment->method 	= Input::get('payment');
			$payment->currency 	= $country->currency;

			$payment->save();

			$redirectString = $order->random_string;

			$emailData = array(
				'order' => array(
					'nameSlug' 		=> $product->nameSlug,
					'orderAmount'	=> $order->amount,
					'hash'			=> $product->hash,
					'price'			=> $product->price,
					'currency'		=> $payment->currency,
					'priceTotal' 	=> $priceTotal,
				),
				'paymentLink' => $redirectString
			);

			//echo '<pre>'; print_r($emailData); echo '</pre>';exit;

			Mail::send('emails.new_order', $emailData, function($message){
				$message->to(Auth::user()->email, Auth::user()->firstname . ' ' . Auth::user()->lastname)
					->subject('[CryptoWaveCapital] Your order has been placed');
			});

		    return Redirect::to('pay/' . $redirectString )->with('message', 'Your order has been placed!');

		}else{
			return Redirect::to('orders/buy/'.$id)->with('message', 'The following errors occurred')->withErrors($validator)->withInput();
		}
	}


}