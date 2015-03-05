<?php namespace Atrauzzi\LaravelOauth2Server {

	use Atrauzzi\Oauth2Server\AuthorizationService;
	use Illuminate\Contracts\Foundation\Application;
	use Illuminate\Support\ServiceProvider as Base;
	//
	use Illuminate\Routing\Router;
	use Atrauzzi\Oauth2Server\Config as Oauth2Config;
	use Atrauzzi\LaravelOauth2Server\Config as LaravelOauth2Config;


	class ServiceProvider extends Base {

		/**
		 * Register the service provider.
		 *
		 * @return void
		 */
		public function register() {

			$this->app->singleton('Atrauzzi\Oauth2Server\Config', function (Application $app) {

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

				return $config;

			});

//			$this->app->singleton('Atrauzzi\LaravelOauth2Server\Config', function (Application $app) {
//
//				$config = new LaravelOauth2Config();
//
//				return $config;
//
//			});

			$this->app->singleton('Atrauzzi\Oauth2Server\AuthorizationService', function (Application $app) {

				$grantTypes = [];

				foreach(config('oauth2.grant_types', ['authorization_code']) as $grantType)
					$grantTypes[] = $this->makeServerObject('GrantType', $grantType);

				return new AuthorizationService($app->make('Atrauzzi\Oauth2Server\Config'), $grantTypes);

			});

			$this->app->singleton('Atrauzzi\Oauth2Server\Domain\Repository\AuthorizationCode', 'Atrauzzi\LaravelOauth2Server\Domain\Repository\Cache\AuthorizationCode');
			$this->app->singleton('Atrauzzi\Oauth2Server\Domain\Repository\AccessToken', 'Atrauzzi\LaravelOauth2Server\Domain\Repository\Cache\AccessToken');
			$this->app->singleton('Atrauzzi\Oauth2Server\Domain\Repository\RefreshToken', 'Atrauzzi\LaravelOauth2Server\Domain\Repository\Cache\RefreshToken');

			$this->app->singleton('Atrauzzi\Oauth2Server\Domain\Repository\Scope', 'Atrauzzi\LaravelOauth2Server\Domain\Repository\Eloquent\Scope');
			$this->app->singleton('Atrauzzi\Oauth2Server\Domain\Repository\Client', 'Atrauzzi\LaravelOauth2Server\Domain\Repository\Eloquent\Client');

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

			$packageViewPath = sprintf('%s/../resources/views', __DIR__);
			$this->loadViewsFrom($packageViewPath, 'oauth2');

			$this->publishes([
				$packageViewPath => base_path('resources/views/vendor/oauth2')
			], 'views');

			$this->publishes([sprintf('%s/../config/oauth2.php', __DIR__) => config_path('oauth2.php')], 'config');
			$this->publishes([sprintf('%s/../database/migrations/', __DIR__) => base_path('/database/migrations')],	'migrations');

		}

		/**
		 * @param \Illuminate\Routing\Router $router
		 */
		protected function registerRoutes(Router $router) {

			$router->group(['namespace' => 'Atrauzzi\LaravelOauth2Server\Http\Controller', 'prefix' => 'oauth2'], function(Router $router) {

				$router->get('authorize', [
					'as' => 'oauth2.create-authorization',
					'uses' => 'Authorization@create',
					'middleware' => 'auth'
				]);

				$router->get('invalid-authorization', [
					'as' => 'oauth2.invalid-authorization',
					'uses' => 'Authorization@invalid',
				]);

				$router->post('authorize', [
					'as' => 'oauth2.store-authorization',
					'uses' => 'Authorization@store',
					'middleware' => 'auth'
				]);

			});

		}

		/**
		 * Convenience method to build core server objects.
		 *
		 * @param string ...$parts
		 * @return string
		 */
		protected function makeServerObject() {

			$parts = func_get_args();

			if(is_array($parts[0]))
				$parts = $parts[0];

			$parts = array_map('studly_case', $parts);
			array_unshift($parts, 'Atrauzzi', 'Oauth2Server');

			return $this->app->make(implode('\\', $parts));

		}

	}

}