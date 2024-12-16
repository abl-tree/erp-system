<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class MeController extends Controller
{
    public function __invoke(Request $request)
    {
        Cache::tags(['users'])->put('test-key-cache2', 'Hello, Redis!', 60);

         // Set a key-value pair
        Redis::set('test-key2', 'Hello, Redis!', 'EX', 60);

        // Get the value
        $value = Redis::get('test-key');

        return new UserResource($request->user());
    }
}
