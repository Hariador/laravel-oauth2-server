<?php namespace Atrauzzi\LaravelOauth2Server\Http\Request {

	use Illuminate\Foundation\Http\FormRequest;


	class Base extends FormRequest {

		protected $rootNamespace = 'Atrauzzi\LaravelOauth2Server\Http\Controller';

		public function rules() {
			return [
			];
		}

	}

}