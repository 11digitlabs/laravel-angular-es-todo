<?php

namespace App\Providers;

use App\Observers\ElasticsearchTaskObserver;
use App\Task;
use Elasticsearch\Client;
use Illuminate\Support\ServiceProvider;

class ObserverServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Task::observe( $this->app->make( ElasticsearchTaskObserver::class ) );
    }

    public function register()
    {
        $this->app->bindShared( ElasticsearchTaskObserver::class, function () {
            return new ElasticsearchTaskObserver( new Client() );
        } );
    }
}