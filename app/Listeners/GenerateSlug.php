<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Queue\InteractsWithQueue;

class GenerateSlug
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Model $model): void
    {
        if ($model->isDirty('name')) {
            $model->slug = Str::slug($model->name);
        }
    }
}
