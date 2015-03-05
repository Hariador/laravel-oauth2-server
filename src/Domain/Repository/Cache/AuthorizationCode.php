<?php namespace Atrauzzi\LaravelOauth2Server\Domain\Repository\Cache {

	use Atrauzzi\Oauth2Server\Domain\Repository\AuthorizationCode as AuthorizationCodeRepository;
	//
	use Atrauzzi\Oauth2Server\Domain\Entity\AuthorizationCode as AuthorizationCodeContract;
	use Atrauzzi\LaravelOauth2Server\Domain\Entity\AuthorizationCode as AuthorizationCodeEntity;
	use DateTime;


	class AuthorizationCode extends Base implements AuthorizationCodeRepository {

		/**
		 * Create a new AuthorizationCode entity.
		 *
		 * @param string $id
		 * @param int $expireTime
		 * @param int|string $oauthableId
		 * @param string|int $oauthableType
		 * @param int $clientId
		 * @param string[] $scopeNames
		 * @param string $redirectUri
		 * @return \Atrauzzi\Oauth2Server\Domain\Entity\AuthorizationCode
		 */
		public function create($id, $expireTime, $oauthableId, $oauthableType, $clientId, array $scopeNames, $redirectUri) {
			return new AuthorizationCodeEntity($id, $expireTime, $oauthableId, $oauthableType, $clientId, $scopeNames, $redirectUri);
		}

		/**
		 * @param string $id
		 * @return \Atrauzzi\Oauth2Server\Domain\Entity\AuthorizationCode
		 */
		public function find($id) {
			return $this->cache->get($this->getKey('authorization_code', $id));
		}

		/**
		 * @param \Atrauzzi\Oauth2Server\Domain\Entity\AuthorizationCode $authorizationCode
		 */
		public function persist(AuthorizationCodeContract $authorizationCode) {
			$this->cache->put(
				$this->getKey('authorization_code', $authorizationCode->getId()),
				$authorizationCode,
				new DateTime($authorizationCode->getExpireTime())
			);
		}

		/**
		 * @param \Atrauzzi\Oauth2Server\Domain\Entity\AuthorizationCode|string $id
		 */
		public function delete($id) {

			if($id instanceof AuthorizationCodeEntity)
				$id = $id->getId();

			$this->cache->forget($this->getKey('authorization_code', $id));

		}

	}

}