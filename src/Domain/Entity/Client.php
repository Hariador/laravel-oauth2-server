<?php namespace Atrauzzi\LaravelOauth2Server\Domain\Entity {

	use Illuminate\Database\Eloquent\Model;
	use Atrauzzi\Oauth2Server\Domain\Entity\Client as ClientContract;


	class Client extends Model implements ClientContract {

		/** @var string */
		protected $table = 'oauth2_client';

		/** @var bool */
		public $incrementing = false;

		protected $fillable = [
			'id',
			'secret',
			'name',
			'description',
			'redirect_uri'
		];

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