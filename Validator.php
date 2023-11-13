<?php

class Validator {

    public static function string($value, $min = 1, $max = INF){ //最大値、最小値を決める

        $value = trim($value); //trimを入れると、blank spaceを取り除ける。

        return strlen($value) > $min && strlen($value) < $max; //最大値、最小値の条件を満たすかどうかをBoolで返す
    
    
    }
}

