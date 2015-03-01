<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {

		Schema::create('oauth_client', function(Blueprint $table) {

			$table->increments('id');

			$table->string('name')->unique();

			$table->string('secret')->unique();

			$table->string('redirect_uri')->nullable();

			$table->timestamps();

		});

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('oauth_client');
	}

}