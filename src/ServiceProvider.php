<?php namespace Atrauzzi\LaravelOauth2Server {

	use Illuminate\Contracts\Foundation\Application;
	use Illuminate\Support\ServiceProvider as Base;
	//
	use Illuminate\Routing\Router;
	use League\Oauth2\Server\Config as Oauth2Config;
	use Atrauzzi\LaravelOauth2Server\Config as LaravelOauth2Config;


	class ServiceProvider extends Base {

		/**
		 * Register the service provider.
		 *
		 * @return void
		 */
		public function register() {

			$this->app->singleton('League\Oauth2\Server\Config', function (Application $app) {

				$config = new Oauth2Config();

				$config
					->setTokenStrategy($this->makeServerObject('TokenStrategy', config('token_strategy', 'bearer')))
					->setAuthorizationCodeTtl(config('oauth2.authorization_code_ttl', '300'))
					->setAccessTokenTtl(config('oauth2.access_token_ttl', 3600))
					->setRefreshTokenTtl(config('oauth2.refresh_token_ttl', 604800))
					->requireScopeParam(config('oauth2.require_scopes', false))
					->requireStateParam(config('oauth2.require_state', false))
					->rotateRefreshTokens(config('oauth2.rotate_refresh_tokens', false))
					->setDefaultScopes(config('oauth2.default_scopes'))
				;

				foreach(config('oauth2.grant_types', ['authorization_code']) as $grantType)
					$config->addGrantType($this->makeServerObject('GrantType', $grantType));

				return $config;

			});

			$this->app->singleton('Atrauzzi\LaravelOauth2Server\Config', function (Application $app) {

				$config = new LaravelOauth2Config();



				return $config;

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

		/**
		 * Convenience method to build core server objects.
		 *
		 * @param string|string[] $parts
		 * @return mixed
		 */
		protected function makeServerObject($parts) {

			if(!is_array($parts))
				$parts = func_get_args();

			$parts = array_map('studly_case', $parts);
			array_unshift($parts, 'League', 'Oauth2', 'Server');

			return $this->app->make(implode('\\', $parts));

		}

	}

}