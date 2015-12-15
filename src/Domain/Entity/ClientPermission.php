<?php namespace Atrauzzi\LaravelOauth2Server\Domain\Entity {

	use Illuminate\Database\Eloquent\Model;

	class ClientPermission extends Model {


		protected $table = 'oauth2_client_scope';

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
				'client_scope_pivot',
				'scope_id',
				'client_id');
		}

	}
}