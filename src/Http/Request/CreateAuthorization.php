<?php namespace Atrauzzi\LaravelOauth2Server\Http\Request {

	use Atrauzzi\Oauth2Server\Domain\Service\Scope as ScopeService;
	//
	use Atrauzzi\Oauth2Server\Domain\Entity\Oauthable;
	use Atrauzzi\Oauth2Server\Exception\InvalidScope;


	class CreateAuthorization extends Base {

		/** @var \Atrauzzi\Oauth2Server\Domain\Entity\Scope[] */
		protected $requestedScopes;

		/** @var string */
		protected $redirectRoute = 'oauth2.invalid-authorization';

		/**
		 * @return array
		 */
		public function rules() {
			return [
				'client_id' => 'required',
				'scope' => 'regex:^(\w+ ?)*$',
				'state' => 'min:1'
			];
		}

		/**
		 * The currently authenticated type must implement oauthable.
		 *
		 * @param \Atrauzzi\Oauth2Server\Domain\Service\Scope $scopeService
		 * @return bool
		 */
		public function authorize(ScopeService $scopeService) {

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

			return $this->user() instanceof Oauthable;

		}

		/**
		 * @return \Atrauzzi\Oauth2Server\Domain\Entity\Scope[]
		 */
		public function getRequestedScopes() {
			return $this->requestedScopes;
		}

	}

}