<?php namespace Atrauzzi\LaravelOauth2Server\Http\Controller {

	use Illuminate\Http\Request;
	use Illuminate\Routing\Controller;
	//
	use Atrauzzi\Oauth2Server\AuthorizationService;
	use Atrauzzi\Oauth2Server\GrantType\AuthorizationCode as AuthorizationCodeGrant;
	use Atrauzzi\LaravelOauth2Server\Http\Request\CreateAuthorization;
	use Atrauzzi\LaravelOauth2Server\Http\Request\StoreAuthorization;
	//
	use Illuminate\Http\JsonResponse;


	class Authorization extends Controller {

		/** @var \Atrauzzi\Oauth2Server\AuthorizationService */
		protected $authorizationService;

		/**
		 * @param \Atrauzzi\Oauth2Server\AuthorizationService $authorizationService
		 */
		public function __construct(AuthorizationService $authorizationService) {
			$this->authorizationService = $authorizationService;
		}

		/**
		 * @param \Atrauzzi\LaravelOauth2Server\Http\Request\CreateAuthorization $request
		 */
		public function create(CreateAuthorization $request) {

			// Get scopes or default scopes.

		}

		/**
		 * @return \Illuminate\View\View
		 */
		public function invalid() {
			return view('oauth2::authorization_invalid');
		}

		public function store(StoreAuthorization $request) {

//			$authorizationData = $this->authorizationService->doFlow(
//				$request,
//				AuthorizationCodeGrant::FLOW_AUTHORIZE
//			);
//
//			return new JsonResponse($authorizationData);

		}

		public function exchange() {

		}

	}

}