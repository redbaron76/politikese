<?php namespace Politikese\Providers;

use Illuminate\Support\ServiceProvider;

// use AmbientDesk\Services\Events\RoleSubscriber;

class EventServiceProvider extends ServiceProvider {

	/**
	 * Register this service provider
	 * 
	 * @return void
	 */
	public function register()
	{
		// $this->app->events->subscribe(new RoleSubscriber);

	}

	/**
	 * Boot this service provider
	 * 
	 * @return void
	 */
	public function boot()
	{
		// 
	}

}