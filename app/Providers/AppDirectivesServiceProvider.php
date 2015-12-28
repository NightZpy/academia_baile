<?php namespace App\Providers;

/**
 * This file is part of Entrust,
 * a role & permission management solution for Laravel.
 *
 * @license MIT
 * @package Zizaco\Entrust
 */

use Illuminate\Support\ServiceProvider;

class AppDirectivesServiceProvider extends ServiceProvider
{
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

		// Register blade directives
		$this->bladeDirectives();
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{

	}

	/**
	 * Register the blade directives
	 *
	 * @return void
	 */
	private function bladeDirectives()
	{
		\Blade::directive('route', function($expression) {
			return "<?php if (request()->route()->getName() == $expression): ?>";
		});

		\Blade::directive('endroute', function($expression) {
			return "<?php endif; ?>";
		});
	}
}