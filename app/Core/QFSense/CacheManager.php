<?php

namespace App\Core\QFSense;

use Illuminate\Support\Facades\Cache;

class CacheManager
{
    public function remember(string $key, callable $callback, int $seconds = 5): mixed
    {
        return Cache::remember(
            $key,
            now()->addSeconds($seconds),
            $callback
        );
    }
}
