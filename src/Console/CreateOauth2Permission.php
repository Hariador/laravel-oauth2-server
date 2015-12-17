<?php namespace Atrauzzi\LaravelOauth2Server\Console {

	use Illuminate\Console\Command;
	use Atrauzzi\LaravelOauth2Server\Domain\Entity\Permission;


	class CreateOauth2Permission extends Command {

		/**
		 * The name and signature of the console command.
		 *
		 * @var string
		 */
		protected $signature = 'oauth2:create-permission {permission_name} {permission_desc}';

		/**
		 * The console command description.
		 *
		 * @var string
		 */
		protected $description = 'Used to create Oauth Permissions for Clients.  Use this until we create some sort of admin frontend
								  {permission_name : Name of the permission}
								  {permission_desc : Description of the permission}';
		/**
		 * Create a new command instance.
		 *
		 * @return void
		 */
		public function __construct() {
			parent::__construct();
		}

		/**
		 * Execute the console command.
		 *
		 * @return mixed
		 */
		public function handle() {

			$permissionName = $this->argument('permission_name');
			$permissionDesc = $this->argument('permission_desc');
			$permission = new Permission(['name'=>$permissionName,'description'=>$permissionDesc]);
			$permission->save();
		}
	}
}
