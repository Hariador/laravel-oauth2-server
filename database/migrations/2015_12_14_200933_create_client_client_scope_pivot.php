<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientClientPermissions extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('oauth2_client_permissions', function (Blueprint $table) {
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
		Schema::drop('client_permissions');
	}
}
