<?php

namespace App\Http\Middleware;

use App\Helper\WrapperError;
use Closure;
use Illuminate\Http\Request;
use PHPUnit\Framework\Constraint\IsEmpty;

class ApiKey
{
    public function handle(Request $request, Closure $next)
    {
        $apikeySet = env('API_KEY');
        $apiKey = $request->header('key');
        if (!isset($apiKey)) {
            return WrapperError::error(403);
        }

        if ($apiKey !== $apikeySet) {
            return WrapperError::error(401);
        }

        return $next($request);
    }
}
