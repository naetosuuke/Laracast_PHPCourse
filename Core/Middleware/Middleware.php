<?php

namespace Core\Middleware;



class Middleware
{
    public const MAP = [
        'guest' => Guest::class,
        'auth' => Auth::class
    ];

    public static function resolve($key)
    {   
        if (! $key){ //middlewareに値がなかったらエスケープ
            return;
        }

        $middleware = static::MAP[$key];

        if(!$middleware) { //MAP上にmiddlewareと該当する値がなかったら
            throw new \Exception("No maching middleware founf for key '{$key}'.");
        }

        (new $middleware)->handle();
    }

}