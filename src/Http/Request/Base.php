<?php namespace Atrauzzi\LaravelOauth2Server\Http\Request {

	use Illuminate\Foundation\Http\FormRequest;


	class Base extends FormRequest {

		public function rules() {
			return [
			];
		}

		public function authorize() {
			return true;
		}

	}

}