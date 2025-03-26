<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\CreatingUser;
use App\Listeners\GenerateIdNumber;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        CreatingUser::class => [
            GenerateIdNumber::class,
        ],
    ];

    public function boot()
    {
        parent::boot();
    }
}
