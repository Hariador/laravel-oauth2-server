<?php namespace Atrauzzi\LaravelOauth2Server\Http\Controller {

	use Illuminate\Routing\Controller;
	//
	use League\Oauth2\Server\AuthorizationService;
	use League\Oauth2\Server\GrantType\AuthorizationCode as AuthorizationCodeGrant;
	use Atrauzzi\LaravelOauth2Server\Http\Request\CreateAuthorization;
	use Atrauzzi\LaravelOauth2Server\Http\Request\StoreAuthorization;
	//
	use Illuminate\Http\JsonResponse;


	class Authorization extends Controller {

		/** @var \League\Oauth2\Server\AuthorizationService */
		protected $authorizationService;

		/**
		 * @param \League\Oauth2\Server\AuthorizationService $authorizationService
		 */
		public function __construct(AuthorizationService $authorizationService) {
			$this->authorizationService = $authorizationService;
		}

		/**
		 * @param \Atrauzzi\LaravelOauth2Server\Http\Request\CreateAuthorization $request
		 */
		public function create(CreateAuthorization $request) {

			// Require authenticated.

			// Ensure authenticated is an oauthable.

			// If authenticated, show oauth approval form.

		}

		public function store(StoreAuthorization $request) {

			$authorizationData = $this->authorizationService->doFlow(
				$request,
				AuthorizationCodeGrant::FLOW_AUTHORIZE
			);

			return new JsonResponse($authorizationData);

		}

		public function exchange() {

		}

	}

}