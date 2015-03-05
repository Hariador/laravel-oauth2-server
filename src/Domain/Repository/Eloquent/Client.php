<?php namespace Atrauzzi\LaravelOauth2Server\Domain\Repository\Eloquent {

	use Atrauzzi\Oauth2Server\Domain\Repository\Client as ClientRepository;
	//
	use Atrauzzi\LaravelOauth2Server\Domain\Entity\Client as EloquentClient;


	class Client implements ClientRepository {

		/**
		 * Find a client by criteria.
		 *
		 * @param string $id The client's ID
		 * @param string $secret The client's secret (default = "null")
		 * @param string $redirectUri The client's redirect URI (default = "null")
		 * @param string $grantType The grant type used (default = "null")
		 * @return \Atrauzzi\Oauth2Server\Domain\Entity\Client
		 */
		public function find($id, $secret = null, $grantType = null, $redirectUri = null) {

			$query = EloquentClient::query();

			if($id)
				$query->where('id', $id);

			if($secret)
				$query->where('secret', $secret);

			// ToDo: Support matching by grant.

			if($redirectUri)
				$query->where('redirect_uri', $redirectUri);

			return $query->first();

		}

	}

}