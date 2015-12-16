<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientPermission extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('oauth2_client_permission', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('permission_id');
			$table->string('client_id');
			$table->unique([
				'client_id',
				'permission_id'
			]);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('oauth2_client_permission');
	}
}
