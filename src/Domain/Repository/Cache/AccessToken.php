<?php namespace Atrauzzi\LaravelOauth2Server\Domain\Repository\Cache {

	use League\Oauth2\Server\Domain\Repository\AccessToken as AccessTokenRepository;
	//
	use League\Oauth2\Server\Domain\Entity\AccessToken as AccessTokenContract;
	use Atrauzzi\LaravelOauth2Server\Domain\Entity\AccessToken as AccessTokenEntity;
	use DateTime;


	class AccessToken extends Base implements AccessTokenRepository {

		/**
		 * Creates a new instance of an AccessToken implementation.
		 *
		 * @param string $id
		 * @param int $expireTime
		 * @param int|string $oauthableId
		 * @param string|int $oauthableType
		 * @param int $clientId
		 * @param string[] $scopeNames
		 * @return \Atrauzzi\LaravelOauth2Server\Domain\Entity\AccessToken
		 */
		public function create($id, $expireTime, $oauthableId, $oauthableType, $clientId, array $scopeNames) {
			return new AccessTokenEntity($id, $expireTime, $oauthableId, $oauthableType, $clientId, $scopeNames);
		}

		/**
		 * Get an instance of Entity\AccessTokenEntity
		 *
		 * @param string $id
		 * @return \League\Oauth2\Server\Domain\Entity\AccessToken|null
		 */
		public function find($id) {
			return $this->cache->get($this->getKey('access_token', $id));
		}

		/**
		 * Creates a new access token
		 * @param \League\Oauth2\Server\Domain\Entity\AccessToken $accessToken
		 */
		public function persist(AccessTokenContract $accessToken) {
			$this->cache->put(
				$this->getKey('access_token', $accessToken->getId()),
				$accessToken,
				new DateTime($accessToken->getExpireTime())
			);
		}

		/**
		 * Permanently delete an AccessToken
		 *
		 * @param \Atrauzzi\LaravelOauth2Server\Domain\Entity\AccessToken|string $id
		 */
		public function delete($id) {

			if($id instanceof AccessTokenEntity)
				$id = $id->getId();

			$this->cache->forget($this->getKey('access_token', $id));

		}

	}

}