<?php namespace Atrauzzi\LaravelOauth2Server\Domain\Repository\Cache {

	use League\Oauth2\Server\Domain\Repository\RefreshToken as RefreshTokenRepository;
	//
	use League\Oauth2\Server\Domain\Entity\RefreshToken as RefreshTokenContract;
	use Atrauzzi\LaravelOauth2Server\Domain\Entity\RefreshToken as RefreshTokenEntity;
	use DateTime;


	class RefreshToken extends Base implements RefreshTokenRepository {

		/**
		 * Create a new RefreshToken entity.
		 *
		 * @param string $id
		 * @param int $expireTime
		 * @param int|string $oauthableId
		 * @param string|int $oauthableType
		 * @param int $clientId
		 * @param string[] $scopeNames
		 * @return \League\Oauth2\Server\Domain\Entity\RefreshToken
		 */
		public function create($id, $expireTime, $oauthableId, $oauthableType, $clientId, array $scopeNames) {
			return new RefreshTokenEntity($id, $expireTime, $oauthableId, $oauthableType, $clientId, $scopeNames);
		}

		/**
		 * @param string $id
		 * @return \League\Oauth2\Server\Domain\Entity\RefreshToken
		 */
		public function find($id) {
			return $this->cache->get($this->getKey('refresh_token', $id));
		}

		/**
		 * @param \League\Oauth2\Server\Domain\Entity\RefreshToken $RefreshToken
		 */
		public function persist(RefreshTokenContract $RefreshToken) {
			$this->cache->put(
				$this->getKey('refresh_token', $RefreshToken->getId()),
				$RefreshToken,
				new DateTime($RefreshToken->getExpireTime())
			);
		}

		/**
		 * @param \League\Oauth2\Server\Domain\Entity\RefreshToken|string $id
		 */
		public function delete($id) {

			if($id instanceof RefreshTokenEntity)
				$id = $id->getId();

			$this->cache->forget($this->getKey('refresh_token', $id));

		}

	}

}