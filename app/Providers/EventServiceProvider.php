<?php

namespace App\Providers;

use App\Events\CreatingBelongsToCreatedBy;
use App\Listeners\FillCreatedByWhenCreatingModel;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * {@inheritDoc}
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        CreatingBelongsToCreatedBy::class => [
            FillCreatedByWhenCreatingModel::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
