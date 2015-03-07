<?php namespace Atrauzzi\LaravelOauth2Server\Http\Request {


	class StoreAuthorization extends BaseAuthorization {

		/** @var string */
		protected $redirectRoute = 'oauth2.invalid-authorization';

		public function rules() {
			return array_merge(parent::rules(), [
				'authorized' => 'required|in:0,1',
				'client_id' => 'required',
				'redirect_uri' => 'min:1',
				'scopes' => ''
			]);
		}

	}

}