<?php namespace Atrauzzi\LaravelOauth2Server\Http\Controller {

	use Illuminate\Routing\Controller;
	//
	use Atrauzzi\Oauth2Server\AuthorizationService;
	use Atrauzzi\Oauth2Server\GrantType\AuthorizationCode as AuthorizationCodeGrant;
	use Atrauzzi\LaravelOauth2Server\Http\Request\CreateAuthorization;
	use Atrauzzi\LaravelOauth2Server\Http\Request\StoreAuthorization;
	//
	use Illuminate\Http\JsonResponse;


	class Authorization extends Controller {

		/**
		 * @param \Atrauzzi\LaravelOauth2Server\Http\Request\CreateAuthorization $request
		 * @return \Illuminate\View\View
		 */
		public function create(CreateAuthorization $request) {

			return view('oauth2::authorization_create', [
				'client' => $request->getClient(),
				'requestedScopes' => $request->getRequestedScopes(),
				'storeUrl' => route('oauth2.store-authorization', $request->query())
			]);

		}

		/**
		 * @return \Illuminate\View\View
		 */
		public function invalid() {
			return view('oauth2::authorization_invalid');
		}

		/**
		 * @param \Atrauzzi\LaravelOauth2Server\Http\Request\StoreAuthorization $request
		 * @param \Atrauzzi\Oauth2Server\AuthorizationService $authorizationService
		 * @return \Illuminate\Http\JsonResponse|string
		 */
		public function store(StoreAuthorization $request, AuthorizationService $authorizationService) {

			if($request->get('authorized'))
				$flow = AuthorizationCodeGrant::FLOW_AUTHORIZE;
			else
				$flow = AuthorizationCodeGrant::FLOW_REJECTED;

			$authorizationData = $authorizationService->doFlow($request, $flow, $request->user());

			return redirect($authorizationData['redirect_uri']);

		}

		public function exchangeCode(AuthorizationService $authorizationService) {

			// Return code.

		}

	}

}