<?php

class LoginController extends BaseController{

	protected $rules = array('email'=>'required','password'=>'required');

	public function showLogin( $intended = null ){
		$data = array(
			'intended' => $intended
		);

		return View::make('loginIndex', $data);
	}

	public function doLogin(){
		$rules = array(
			'email'		=> 'required|email',
			'password'	=> 'required|alphaNum|min:3'
		);

		$validator = Validator::make(Input::all(), $rules);

		if( $validator->fails() )
		{
			return Redirect::to('login')->withErrors($validator)->withInput();
		}else{

			$userdata = array(
				'email'		=> Input::get('email'),
				'password'	=> Input::get('password')
			);

			if( !Auth::attempt($userdata, true) )
			{
				return Redirect::to('login')->with('message', 'No account found with this data');
			}else{
				return (Input::has('intended')?Redirect::to('orders/buy/' . Input::get('intended')):Redirect::to('products'));
			}
		}

	}

	public function store(){
		if( Auth::attempt(Input::only( ['email', 'password']), true )){
			return Redirect::to('/');
		}else{
			return Redirect::back()->withInput->with( 'message', 'Incorrect email or passowrd');
		}
	}

	public function doLogout(){
		Auth::logout();
		return Redirect::to('login');
	}

}