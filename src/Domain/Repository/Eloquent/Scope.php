<?php namespace Atrauzzi\LaravelOauth2Server\Domain\Repository\Eloquent {

	use League\Oauth2\Server\Domain\Repository\Scope as ScopeRepository;
	//
	use Atrauzzi\LaravelOauth2Server\Domain\Entity\Scope as EloquentScope;


	class Scope implements ScopeRepository {

		/**
		 * Find an individual scope.
		 *
		 * @param string $id The scope
		 * @param string $grantType The grant type used in the request (default = "null")
		 * @param string $clientId The client sending the request (default = "null")
		 * @return \League\Oauth2\Server\Domain\Entity\Scope
		 */
		public function find($id, $clientId = null, $grantType = null) {

			$query = EloquentScope::query();

			if($id)
				$query->where('id', $id);

			// ToDo: Support matching by client.

			// ToDo: Support matching by grant.

			return $query->first();

		}

		/**
		 * Finds all scopes with the supplied identifiers, keyed by id.  Returns all if null.
		 *
		 * @param string[] $names
		 * @param null|string $clientId
		 * @param null|string $grantTypeIdentifier
		 * @return \League\Oauth2\Server\Domain\Entity\Scope[]
		 */
		public function findByNames(array $names, $clientId = null, $grantTypeIdentifier = null) {

			/** @var \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query */
			$query = EloquentScope::query();

			if(!empty($names))
				$query->whereIn('name', $names);

			// ToDo: Support matching by client.

			// ToDo: Support matching by grant.

			return $query->get()->keyBy('name');

		}

	}

}