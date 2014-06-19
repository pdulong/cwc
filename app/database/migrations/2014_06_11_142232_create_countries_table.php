<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('countries', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('countrySlug', 5);
			$table->timestamps();
		});

		DB::table('countries')->insert(array(
			array('countrySlug' => 'nl'),
			array('countrySlug' => 'be'),
			array('countrySlug' => 'de'),
			array('countrySlug' => 'uk')
		));
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('countries');
	}

}
