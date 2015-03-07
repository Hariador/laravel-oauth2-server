<?php namespace Atrauzzi\LaravelOauth2Server\Console {

	use Illuminate\Console\Command;
	//
	use Symfony\Component\Console\Input\InputOption;
	use Symfony\Component\Console\Input\InputArgument;
	use Atrauzzi\LaravelOauth2Server\Domain\Entity\Client;
	use Atrauzzi\Oauth2Server\Util\SecureKey;


	class CreateClient extends Command {

		/** @var string */
		protected $name = 'oauth2:create-client';

		/** @var string */
		protected $description = 'Create a new oauth2 client.';

		/**
		 * Execute the console command.
		 *
		 * @return mixed
		 */
		public function handle() {

			$attributes = [
				'id' => $this->option('id') ?: SecureKey::generate(),
				'secret' => $this->option('secret') ?: SecureKey::generate(),
				'name' => $this->argument('name'),
				'redirect_uri' => $this->argument('redirect-uri')
			];

			$newClient = Client::create($attributes);

			$this->info("Your new client has been created!");
			$this->info(sprintf("Client name   : %s", $newClient->getName()));
			$this->info(sprintf("Client ID     : %s", $newClient->getId()));
			$this->info(sprintf("Client secret : %s", $newClient->getSecret()));
			$this->info(sprintf("Client URI    : %s", $newClient->getRedirectUri()));

		}

		/**
		 * @return array
		 */
		protected function getArguments() {
			return [
				['name', null, InputArgument::REQUIRED, 'The name this client will have.'],
				['redirect-uri', null, InputArgument::REQUIRED, 'The redirect URI for the client.'],
			];
		}

		/**
		 * @return array
		 */
		protected function getOptions() {
			return [
				['id', null, InputOption::VALUE_REQUIRED, 'Manually assigned ID.'],
				['secret', null, InputOption::VALUE_REQUIRED, 'Manually assigned secret.'],
				['description', null, InputOption::VALUE_REQUIRED, 'A description of the client.'],
			];
		}

	}

}