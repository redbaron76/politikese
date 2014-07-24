<?php namespace Politikese\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;

class PolitikeseServiceProvider extends ServiceProvider {

	/**
	 * [$defer description]
	 * @var boolean
	 */
	protected $defer = false;

	/**
	 * Get an instance of AliasLoader
	 * 
	 * @return instance
	 */
	protected $aliasLoader;

	/**
	 * [boot description]
	 * @return [type] [description]
	 */
	public function boot()
	{
		// Instantiate AliasLoader
		$this->aliasLoader = AliasLoader::getInstance();

		// Run accessor methods
		$this->loadServiceProviders();
		$this->bindServices();
		$this->bindRepositories();
		$this->activateFacades();

		// Inclusions
		require __DIR__.'/../start.php';
		require __DIR__.'/../helpers.php';
	}

	/**
	 * [register description]
	 * @return [type] [description]
	 */
	public function register()
	{
		// 
	}

	/**
	 * Load custom service providers
	 *
	 * @return void
	 */
	protected function loadServiceProviders()
	{
		$app = $this->app;
		
		$providers = $app['config']['system.providers'];
		
		$provider_path = 'Politikese\Providers\\';	

		foreach ($providers as $provider)
		{
			if (substr_count($provider, '\\') > 0) $provider_path = '';

			$provider_name = "{$provider_path}{$provider}";
			
			$app->register($provider_name);
		}
	}

	/**
	 * Bind repositories
	 *
	 * @return void
	 */
	protected function bindRepositories()
	{		
		$app = $this->app;
		$repositories = $app['config']['system.repositories'];

		foreach ($repositories as $repo) {
			$app->$repo['method']($repo['interface'], $repo['class']);
		}
	}

	/**
	 * Bind services
	 * 
	 * @return void
	 */
	protected function bindServices()
	{
		$app = $this->app;

		$services = $app['config']['system.services'];

		foreach ($services as $service)
		{
			$app->$service['method']($service['interface'], $service['class']);
		}
	}

	/**
	 * Activate custom Facades
	 *
	 * @return void
	 */
	protected function activateFacades()
	{
		$app = $this->app;
		$facades = $app['config']['system.facades'];
		
		foreach ($facades as $facade => $path)
		{
			$injections = array();

			if(is_array($path['depes']))
			{
				foreach ($path['depes'] as $depinj)
				{
					$injections[] = (array_key_exists('interface', $depinj)) ?
						$this->app->make($depinj['interface']) : new $depinj['class'];
				}
			}
			
			// Share facade name
			$app[$facade] = $app->share(function($app) use ($path, $injections)
			{
				return $this->createInstance($path['class'], $injections);
			});
			
			// Alias facade
			$app->booting(function() use ($facade, $path)
			{
				$this->aliasLoader->alias($facade, $path['alias']);
			});
		}
	}

	/**
	 * Instantiate a class with dependency classes
	 * 
	 * @param  class $class
	 * @param  array $params
	 * @return obj
	 */
	private function createInstance($class, $params = array())
	{
		$reflection_class = new \ReflectionClass($class);

		return $reflection_class->newInstanceArgs($params);
	}

}