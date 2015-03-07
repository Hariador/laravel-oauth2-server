<?php namespace Atrauzzi\LaravelOauth2Server\Http\Request {


	class CreateAuthorization extends BaseAuthorization {

		/** @var string */
		protected $redirectRoute = 'oauth2.invalid-authorization';

		/**
		 * @return array
		 */
		public function rules() {
			return array_merge(parent::rules(), [
				// ToDo: Add support for this.
				'prompt' => 'in:force,auto'
			]);
		}

	}

}