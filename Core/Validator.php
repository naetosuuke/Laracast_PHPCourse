<?php

namespace Core;

class Validator {

    public static function string($value, $min = 1, $max = INF)
    { //最大値、最小値のデフォルト値

        $value = trim($value); //trimを入れると、blank spaceを取り除ける。

        return strlen($value) > $min && strlen($value) < $max; //最大値、最小値の条件を満たすかどうかをBoolで返す
    
    }

    public static function email($value) //書式確認
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL); 
    }



}

