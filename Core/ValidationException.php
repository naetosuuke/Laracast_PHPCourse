<?php

namespace Core;


class ValidationException extends \Exception //継承
{
    public readonly array $errors; //外部からの上書き不可能、呼び出しは可能　
    public readonly array $old; 

    public static function throw($errors, $old)
    {
        $instance = new static;
       
        $instance->errors = $errors;
        $instance->old = $old;

       throw $instance;
    }



}