<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientClientPermission extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('oauth2_client_permission', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('scope_id');
			$table->string('client_id');
			$table->unique([
				'client_id',
				'scope_id'
			]);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('client_permission');
	}
}
