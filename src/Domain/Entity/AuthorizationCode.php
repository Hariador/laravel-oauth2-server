<?php namespace Atrauzzi\LaravelOauth2Server\Domain\Entity {

	use Atrauzzi\Oauth2Server\Domain\Entity\AuthorizationCode as AuthorizationCodeContract;
	use Atrauzzi\Oauth2Server\Domain\Entity\Impl\AuthorizationCode as AuthorizationCodeImpl;


	class AuthorizationCode implements AuthorizationCodeContract {

		use AuthorizationCodeImpl;


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
		protected $redirectUri;

		/**
		 * @param string $id
		 * @param int $expireTime
		 * @param int|string $oauthableId
		 * @param string|int $oauthableType
		 * @param int $clientId
		 * @param string[] $scopeNames
		 * @param string $redirectUri
		 */
		public function __construct($id, $expireTime, $oauthableId, $oauthableType, $clientId, array $scopeNames, $redirectUri) {
			$this->id = $id;
			$this->expireTime = $expireTime;
			$this->oauthableId = $oauthableId;
			$this->oauthableType = $oauthableType;
			$this->clientId = $clientId;
			$this->scopeNames = $scopeNames;
			$this->redirectUri = $redirectUri;
		}

		/**
		 * Get the redirect URI
		 *
		 * @return string
		 */
		public function getRedirectUri() {
			return $this->redirectUri;
		}

		/**
		 * @return null|string
		 */
		public function getId() {
			return $this->id;
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

		/**
		 * @return int
		 */
		public function getExpireTime() {
			return $this->expireTime;
		}

	}

}