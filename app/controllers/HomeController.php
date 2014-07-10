<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function doContact()
	{
		$validator = Validator::make(Input::all(), array(
			'name'       => 'required|min:2',
			'email'      => 'required|min:2|email',
		    'message' 	 => 'required|min:2',
		));

		if( $validator -> passes() )
		{

			$fromEmail 	= Input::get('email');
		    $fromName 	= Input::get('name');
		    $data 		= array('content' => Input::get('message'));

		    $toEmail 	= 'info@cryptowavecapital.com';
		    $toName 	= 'CW Capital';

		    Mail::send('emails.contact', $data, function($message) use ($toEmail, $toName, $fromEmail, $fromName)
		    {
		        $message->to($toEmail, $toName);

		        $message->from($fromEmail, $fromName);

		        $message->subject('[Contact form] Somebody used the contact form');
		    });

		    return Redirect::to('products#author')->with('contactMessage', trans('interface.contact_Sent'));

		}else{
			return Redirect::to('products#author')->withErrors($validator)->withInput();
		}

	}

}
