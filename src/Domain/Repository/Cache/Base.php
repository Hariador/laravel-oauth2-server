<?php namespace Atrauzzi\LaravelOauth2Server\Domain\Repository\Cache {

	use Illuminate\Cache\CacheManager;


	class Base {

		/** @var \Illuminate\Cache\CacheManager|\Illuminate\Contracts\Cache\Repository */
		protected $cache;

		/**
		 * @param \Illuminate\Cache\CacheManager|\Illuminate\Contracts\Cache\Repository $cache
		 */
		public function __construct(CacheManager $cache) {
			$this->cache = $cache;
		}

		//
		//
		//

		/**
		 * @param string|array $keys
		 * @return string
		 */
		protected function getKey($keys) {

			if(!is_array($keys))
				$keys = func_get_args();

			array_unshift($keys, 'oauth2');

			return implode(':', $keys);

		}

	}

}