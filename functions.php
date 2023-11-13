<?php
function dd($value){ // dump and die
echo "<pre>"; //preタグで挟むと、配列を改行して表示する。(preview)
var_dump($value); //サーバー情報を入手
echo "</pre>";
die(); //この後の関数は一切invokeしないという関数
}


function urlIs($value){ //リクエストしたページ名と合致するか、bool返す
    return $_SERVER['REQUEST_URI'] === $value;
}


function authorize($condition, $status = Response::FORBIDDEN){ //$conditionに設定した条件式がfalseだと403
    if (! $condition) {
        abort($status);
    }
}
