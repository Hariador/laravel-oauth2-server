<?php namespace Atrauzzi\LaravelOauth2Server {

	use Illuminate\Support\ServiceProvider as Base;
	//
	use Illuminate\Routing\Router;
	use League\Oauth2\Server\Config;


	class ServiceProvider extends Base {

		/**
		 * Register the service provider.
		 *
		 * @return void
		 */
		public function register() {

			$this->app->singleton('League\Oauth2\Server\Config', function () {

				$config = new Config();

				return $config
					
				;

			});

			$this->app->singleton('League\Oauth2\Server\Domain\Repository\AuthorizationCode', 'Atrauzzi\LaravelOauth2Server\Domain\Repository\Cache\AuthorizationCode');
			$this->app->singleton('League\Oauth2\Server\Domain\Repository\AccessToken', 'Atrauzzi\LaravelOauth2Server\Domain\Repository\Cache\AccessToken');
			$this->app->singleton('League\Oauth2\Server\Domain\Repository\RefreshToken', 'Atrauzzi\LaravelOauth2Server\Domain\Repository\Cache\RefreshToken');

			$this->app->singleton('League\Oauth2\Server\Domain\Repository\Scope', 'Atrauzzi\LaravelOauth2Server\Domain\Repository\Eloquent\Scope');
			$this->app->singleton('League\Oauth2\Server\Domain\Repository\Client', 'Atrauzzi\LaravelOauth2Server\Domain\Repository\Eloquent\Client');

		}

		public function boot(Router $router) {

			$this->registerPackage();
			$this->registerRoutes($router);

		}

		//
		//
		//

		/**
		 *
		 */
		protected function registerPackage() {

			$this->publishes([sprintf('%s/../config/oauth2.php', __DIR__) => config_path('oauth2.php')], 'config');
			$this->publishes([sprintf('%s/../database/migrations/', __DIR__) => base_path('/database/migrations')],	'migrations');

		}

		/**
		 * @param \Illuminate\Routing\Router $router
		 */
		protected function registerRoutes(Router $router) {

			$router->group(['namespace' => 'Atrauzzi\LaravelOauth2Server\Http\Controller', 'prefix' => 'oauth2'], function(Router $router) {

				$router->post('authorize', '');

			});

		}

	}

}