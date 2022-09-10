<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\OmdbRepository;
use App\Services\RemoteRepositoryInterface;
use Psr\Log\LoggerInterface;
use GuzzleHttp\Client;

class AddFilmsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(RemoteRepositoryInterface::class, function (): RemoteRepositoryInterface {
            $logger = $this->app->get(LoggerInterface::class);

            return new OmdbRepository($logger, new Client(['base_uri' => config('app.external_service_url'), 'http_errors' => false]), config('app.external_service_key'));
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
