<?php

namespace App\Providers;

use Database\Factories\UUIDFactory as FactoriesUUIDFactory;
use Illuminate\Support\ServiceProvider;
use Ramsey\Uuid\UuidFactory;
use Faker\Factory as FakerFactory;

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
        FakerFactory::create()->addProvider(new UUIDFactory());
    }
}
