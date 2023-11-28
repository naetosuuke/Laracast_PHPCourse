<?php

namespace Core;

class App {
    protected static $container; //クラスを保持(シングルトン)

    public static function setContainer($container) // 任意のクラスを永続化
    {
        static::$container = $container;
    }

    public static function container() // 永続化したクラスを呼び出し
    {
        return static::$container;
    }

    public static function bind($key, $resolver) //
    {
        static::container()->bind($key, $resolver);
    }


    public static function resolve($key)
    {
       return static::container()->resolve($key);
    }

}


