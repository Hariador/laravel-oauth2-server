<?php namespace Atrauzzi\LaravelOauth2Server\Domain\Entity {

	use League\Oauth2\Server\Domain\Entity\AccessToken as AccessTokenContract;
	use League\Oauth2\Server\Domain\Entity\Impl\AccessToken as AccessTokenImpl;


	class AccessToken implements AccessTokenContract {

		use AccessTokenImpl;


		/** @var string */
		protected $id;

		/** @var int */
		protected $expireTime;

		/** @var int|string */
		protected $oauthableId;

		/** @var int|string */
		protected $oauthableType;

		/** @var int */
		protected $clientId;

		/** @var string[] */
		protected $scopeNames;

		/** @var string */
		protected $refreshTokenId;

		//
		//

		/**
		 * @param string $id
		 * @param int $expireTime
		 * @param string|int $oauthableId
		 * @param string|int $oauthableType
		 * @param string $clientId
		 * @param string[] $scopeNames
		 */
		public function __construct($id, $expireTime, $oauthableId, $oauthableType, $clientId, array $scopeNames) {
			$this->id = $id;
			$this->expireTime = $expireTime;
			$this->oauthableId = $oauthableId;
			$this->oauthableType = $oauthableType;
			$this->clientId = $clientId;
			$this->scopeNames = $scopeNames;
		}

		/**
		 * @return null|string
		 */
		public function getId() {
			return $this->id;
		}

		/**
		 * @return int
		 */
		public function getExpireTime() {
			return $this->expireTime;
		}

		/**
		 * @return string|int
		 */
		public function getOauthableId() {
			return $this->oauthableId;
		}

		/**
		 * @return string|int
		 */
		public function getOauthableType() {
			return $this->oauthableType;
		}

		/**
		 * @return string
		 */
		public function getClientId() {
			return $this->clientId;
		}

		/**
		 * @return string[]
		 */
		public function getScopeNames() {
			return $this->scopeNames;
		}

		/**
		 * @return string
		 */
		public function getRefreshTokenId() {
			return $this->refreshTokenId;
		}

		//
		//

		/**
		 * @param string $id
		 */
		public function setRefreshTokenId($id) {
			$this->refreshTokenId = $id;
		}

	}

}