<?php namespace Atrauzzi\LaravelOauth2Server\Domain\Entity {

	use Atrauzzi\Oauth2Server\Domain\Entity\RefreshToken as RefreshTokenContract;
	use Atrauzzi\Oauth2Server\Domain\Entity\Impl\RefreshToken as RefreshTokenImpl;


	class RefreshToken implements RefreshTokenContract {

		use RefreshTokenImpl;

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

		/**
		 * @param string $id
		 * @param int $expireTime
		 * @param int|string $oauthableId
		 * @param string|int $oauthableType
		 * @param int $clientId
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
		 * @return string
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
		 * @return int|string
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
		 * @return int
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

	}

}