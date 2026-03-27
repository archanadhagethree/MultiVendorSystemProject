<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Events\OrderPlaced;
use App\Listeners\LogOrderPlaced;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        OrderPlaced::class => [
            LogOrderPlaced::class,
        ],
    ];

    public function boot(): void
    {
        //
    }
}