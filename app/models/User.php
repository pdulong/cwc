<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Laravel\Cashier\BillableInterface;
use Laravel\Cashier\BillableTrait;

class User extends Eloquent implements UserInterface, RemindableInterface, BillableInterface {

use UserTrait, RemindableTrait, BillableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	protected $fillable = array('email','first_name','last_name','address','postal','country','telephone','password');

	public static $rulesRegistration = array(
		'firstname'                => 'required|alpha|min:2',
	    'lastname'                 => 'required|alpha|min:2',
	    'email'                    => 'required|email|unique:users,email',
	    'password'                 => 'required|alpha_num|between:6,12|confirmed',
	    'password_confirmation'    => 'required|alpha_num|between:6,12',
	    'telephone'                => 'required',
	    'address'                  => 'required',
	    'postal'                   => 'required',
	    'country'                  => 'required',
	);

	public function orders()
	{
		return $this->hasMany('orders');
	}





}
