<?php


namespace Core;


class Container
{
    protected $bindings = []; //マップの保管場所

    public function bind($key, $resolver) //クラスの名前空間をキー、初期化関数を値として記録
    {
        $this->bindings[$key] = $resolver;
    }


    public function resolve($key) //名前空間をもらい、マップで持っていれば初期化関数を実行
    {
        if (! array_key_exists($key, $this->bindings)){
            throw new \Exception("No maching binding fond for {$key}");
        }
        $resolver = $this->bindings[$key];
        return call_user_func($resolver);
    }

}



