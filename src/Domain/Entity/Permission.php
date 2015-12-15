<?php namespace Atrauzzi\LaravelOauth2Server\Domain\Entity {

	use Illuminate\Database\Eloquent\Model;

	class ClientPermission extends Model {


		protected $table = 'oauth2_permission';

		protected $fillable = [
			'name',
			'description'
		];

		public $timestamps = true;


		public function getName() {
			return $this->name;
		}

		public function getDescription() {
			return $this->description;
		}

		public function clients() {
			return $this>$this->belongsToMany(
				'Atrauzzi\LaravelOauth2Server\Domain\Entity\Client',
				'oauth2_client_permission',
				'permission_id',
				'client_id');
		}

	}
}