<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\RemoteRepositoryInterface;
use App\Services\MovieFinder;

class MovieFinderServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(MovieFinder::class, function (): MovieFinder {
            $repository = $this->app->get(RemoteRepositoryInterface::class);

            return new MovieFinder($repository);

        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
