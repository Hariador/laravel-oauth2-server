<?php namespace Atrauzzi\LaravelOauth2Server\Domain\Entity {

	use Illuminate\Database\Eloquent\Model;
	use Atrauzzi\Oauth2Server\Domain\Entity\Scope as ScopeContract;


	class Scope extends Model implements ScopeContract {

		/** @var string */
		protected $table = 'oauth2_scope';

		/** @var string */
		protected $primaryKey = 'name';

		/** @var bool */
		public $incrementing = false;

		/**
		 * @param string $name
		 * @param string $description
		 */
		public function __construct($name = null, $description = null) {
			$this->name = $name;
			$this->description = $description;
		}

		/**
		 * Return the scope identifier
		 *
		 * @return string
		 */
		public function getName() {
			return $this->name;
		}

		/**
		 * Return the scope's description
		 *
		 * @return string
		 */
		public function getDescription() {
			return $this->description;
		}

	}

}