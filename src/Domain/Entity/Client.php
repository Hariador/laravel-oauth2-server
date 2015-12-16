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

		public function permissions() {
			return $this->belongsToMany(
				'Atrauzzi\LaravelOauth2Server\Domain\Entity\Permission',
				'oauth2_client_permission',
				'client_id',
				'permission_id');
		}

		public function hasPermission($permission_name) {

			foreach($this->permissions as $permission) {
				error_log($permission->getName(),0);
				if($permission->getName() == $permission_name)
					return true;
			}
			return false;
		}
	}

}