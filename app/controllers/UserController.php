<?php

class UserController extends BaseController{

	protected $layout = 'layouts.master';

	//Show the profile of a user

	public function showProfile($id)
	{
		$user = User::find($id);

		//return View::make('user_profile', array('user' => $user));

		$this->layout->content = View::make('user_profile', array('user' => $user));
	}

}

?>