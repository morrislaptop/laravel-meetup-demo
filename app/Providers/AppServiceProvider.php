<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Kreait\Firebase\Factory;
use Kreait\Firebase;
use Kreait\Firebase\ServiceAccount;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ServiceAccount::class, function ($app) {
            return ServiceAccount::fromArray([
                'project_id'   => config('services.firebase.project_id'),
                'client_id'    => config('services.firebase.client_id'),
                'client_email' => config('services.firebase.client_email'),
                'private_key'  => config('services.firebase.private_key'),
            ]);
        });
        
        $this->app->singleton(Factory::class, function ($app) {
            $factory = (new Factory())->withServiceAccount($app->make(ServiceAccount::class));

            return $factory;
        });

        $this->app->singleton(Firebase::class, function ($app) {
            $firebase = $app->make(Factory::class)->create();

            return $firebase;
        });
    }
}
