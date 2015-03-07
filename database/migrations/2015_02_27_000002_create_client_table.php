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

		Schema::create('oauth2_client', function(Blueprint $table) {

			$table->string('id')->unique()->primary();

			$table->string('name')->unique();

			$table->string('secret')->unique();

			$table->string('redirect_uri');

			$table->timestamps();

		});

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('oauth2_client');
	}

}
