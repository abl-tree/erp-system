<?php

namespace App\Listeners;

use App\Events\CreatingUser;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class GenerateIdNumber
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
    public function handle(CreatingUser $event): void
    {
        $user = $event->user;
        $year = date('Y');

        // Lock to prevent duplicate IDs
        $lastUser = $user->whereYear('created_at', $year)
            ->lockForUpdate()
            ->orderBy('id_number', 'desc')
            ->first();

        $count = $lastUser ? (intval(substr($lastUser->id_number, -5)) + 1) : 1;

        $user->id_number = sprintf("%s-%05d", $year, $count);
    }
}
