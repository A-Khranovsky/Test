<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $parameters = [
            'client_id' => config('oauth.google.client_id'),
            'response_type' => 'code',
            'redirect_uri' => config('oauth.google.call_back'),
            'scope' => 'openid email'
        ];

        View::share(
            'oauth_google_uri',
            'https://accounts.google.com/o/oauth2/v2/auth?' . http_build_query($parameters)
        );
    }
}
