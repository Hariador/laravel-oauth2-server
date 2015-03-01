<?php namespace Atrauzzi\LaravelOauth2Server\Domain\Entity {

	use Illuminate\Database\Eloquent\Model;
	use League\Oauth2\Server\Domain\Entity\Client as ClientContract;


	class Client extends Model implements ClientContract {

		/** @var string */
		protected $table = 'oauth_client';

		/**
		 * @param string $name
		 * @param string $secret
		 * @param string $redirectUri
		 */
		public function __construct($name, $secret, $redirectUri) {
			$this->name = $name;
			$this->secret = $secret;
			$this->redirect_uri = $redirectUri;
		}

		/**
		 * @return int
		 */
		public function getId() {
			return $this->getKey();
		}

		/**
		 * @return string
		 */
		public function getType() {
			return get_class($this);
		}

		/**
		 * Get the client name.
		 *
		 * @return string
		 */
		public function getName() {
			return $this->name;
		}

		/**
		 * Return the client secret.
		 *
		 * @return string
		 */
		public function getSecret() {
			return $this->secret;
		}

		/**
		 * @return string
		 */
		public function getRedirectUri() {
			return $this->redirect_uri;
		}

	}

}