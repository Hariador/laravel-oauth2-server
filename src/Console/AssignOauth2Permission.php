<?php namespace Atrauzzi\LaravelOauth2Server\Console {

	use Illuminate\Console\Command;
	use Atrauzzi\LaravelOauth2Server\Domain\Repository\Eloquent\Client as Client;
	use Atrauzzi\LaravelOauth2Server\Domain\Entity\Permission;


	class AssignOauth2Permission extends Command {

		/**
		 * The name and signature of the console command.
		 *
		 * @var string
		 */
		protected $signature = 'oauth2:assign-client-permission {api_key} {permission_name}';

		/**
		 * @var OauthService
		 */
		protected $client;

		/**
		 * The console command description.
		 *
		 * @var string
		 */
		protected $description = 'Assigns a permission to a client found with API key
                              {api_key: API of the client to assign the permisisont to},
                              {permission_name: Name of the permission}';

		/**
		 * Create a new command instance.
		 *
		 * @return void
		 */
		public function __construct(Client $client) {

			$this->client = $client;
			parent::__construct();
		}

		/**
		 * Execute the console command.
		 *
		 * @return mixed
		 */
		public function handle() {

			$apiKey = $this->argument('api_key');
			$permissionName = $this->argument('permission_name');

			$permission_query = Permission::where('name',$permissionName);
			$permission = $permission_query->first();
			/// @var Atrauzzi\LaravelOauth2Server\Domain\Entity\Client
			$client = $this->client->find(null, $apiKey);
			$client->permissions()->attach($permission);
		}
	}
}
