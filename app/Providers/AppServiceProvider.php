<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
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

        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            dd($notifiable, $url);
            return (new MailMessage)
                ->subject('Validation du compte Adidash')
                ->line('Bienvenue sur Adidash. Vous devez encore activer votre compte pour profiter de toutes les fonctionnalités du site')
                ->action('Vérifier l\'adresse mail', $url);
        });
	}
}
