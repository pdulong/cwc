<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('orderSeeder');
		$this->command->info('Order seeded');
	}

}

class orderSeeder extends Seeder{

	public function run(){
		DB::table('users')->delete();
		DB::table('orders')->delete();
		DB::table('payments')->delete();


		$user1 = User::create(array(
			'email'      => 'pauldulong@gmail.com',
			'firstname'  => 'Paul',
			'lastname'   => 'du Long',
			'address'    => 'Heinsbergerweg 56',
			'postal'     => '6045CH',
			'telephone'  => '0634426965',
			'password'   => Hash::make('Paul1994')
		));

		$this->command->info('User 1 added');

		$order1 = Order::create(array(
			'user_id'    => $user1->id,
			'product_id' => 2
		));

		$this->command->info('Order added');

		$payment1 = Payment::create(array(
			'order_id' => $order1->id,
		));

		$this->command->info('Payment record created');

		//$order1->products()->attach(2);

		//$this->command->info('Linked order to product');

	}
}
