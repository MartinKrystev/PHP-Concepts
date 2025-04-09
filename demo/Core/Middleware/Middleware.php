<?php

namespace Core\Middleware;

use Exception;

class Middleware
{
    public const MAP = [
        'guest' => Guest::class,
        'auth' => Auth::class
    ];

    /**
     * @throws Exception
     */
    public static function resolve($key)
    {
        if (!$key) {
            return;
        }
        // static - the current instance
        $middleware = static::MAP[$key] ?? false;

        if (!$middleware) {
            throw new Exception('No matching middleware found for key '.$key.'.');
        }

        (new $middleware)->handle();
    }
}