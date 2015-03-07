<?php namespace Atrauzzi\LaravelOauth2Server\Http\Request {

	use Atrauzzi\Oauth2Server\Domain\Service\Scope as ScopeService;
	use Atrauzzi\Oauth2Server\Domain\Repository\Client as ClientRepository;
	//
	use Atrauzzi\Oauth2Server\Domain\Entity\Oauthable;
	use Atrauzzi\Oauth2Server\Exception\InvalidScope;


	abstract class BaseAuthorization extends Base {

		/** @var \Atrauzzi\Oauth2Server\Domain\Entity\Scope[] */
		protected $requestedScopes;

		/** @var \Atrauzzi\Oauth2Server\Domain\Repository\Client */
		protected $client;

		/**
		 * @return array
		 */
		public function rules() {
			return [
				'client_id' => 'required|exists:oauth2_client,id',
				'redirect_uri' => 'min:1',
				'scope' => 'regex:^(\w+ ?)*$',
				'state' => 'min:1',
			];
		}

		/**
		 * The currently authenticated type must implement oauthable and we need any scopes requested.
		 *
		 * @param \Atrauzzi\Oauth2Server\Domain\Service\Scope $scopeService
		 * @param \Atrauzzi\Oauth2Server\Domain\Repository\Client $clientRepository
		 * @return bool
		 * @throws \Atrauzzi\Oauth2Server\Exception\InvalidRequest
		 */
		public function authorize(ScopeService $scopeService, ClientRepository $clientRepository) {

			try {
				$this->requestedScopes = $scopeService->findValid(
					$this->get('scope'),
					'authorization',
					$this->get('client_id'),
					$this->get('redirect_uri')
				);
			}
			catch(InvalidScope $ex) {
				return false;
			}

			$this->client = $clientRepository->find(
				$this->get('client_id'),
				null,
				'authorization',
				$this->get('redirect_uri')
			);

			return $this->user() instanceof Oauthable;

		}

		/**
		 * @return \Atrauzzi\Oauth2Server\Domain\Entity\Scope[]
		 */
		public function getRequestedScopes() {
			return $this->requestedScopes;
		}

		/**
		 * @return \Atrauzzi\Oauth2Server\Domain\Repository\Client
		 */
		public function getClient() {
			return $this->client;
		}

	}

}