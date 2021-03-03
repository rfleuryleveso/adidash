<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider {
	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register() {
		//
	}

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot() {
		view()->composer('*', function ($view) {
			view()->share('view_name', $view->getName());
		});
		Paginator::defaultView('vendor.pagination.bulma');

        Paginator::defaultSimpleView('vendor.pagination.simple-default');
	}
}
