<?php namespace MindOfMicah\AuthenticationSystem;

use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('mindofmicah/authentication-system');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
        $this->app['auther.generate'] = $this->app->share(function ($app) {
            return $this->app->make('MindOfMicah\AuthenticationSystem\Commands\AuthenticationInstallCommand');
        });

        $this->commands('auther.generate');
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}
