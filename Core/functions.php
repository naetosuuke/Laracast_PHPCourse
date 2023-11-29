<?php

use Core\Response;

function dd($value){ // dump and die
echo "<pre>"; //preタグで挟むと、配列を改行して表示する。(preview)
var_dump($value); //サーバー情報を入手
echo "</pre>";
die(); //この後の関数は一切invokeしないという関数
}


function urlIs($value){ //リクエストしたページ名と合致するか、bool返す
    return $_SERVER['REQUEST_URI'] === $value;
}


function abort($code = 404){
    http_response_code($code); //404コードを返す(クライアント側への通知)
    require base_path("views/{$code}.php");
    die();
}


function authorize($condition, $status = Response::FORBIDDEN)
{ //$conditionに設定した条件式がfalseだと403
    if (! $condition) {
        abort($status); 
    }
}

function base_path($path) //base_path関数を利用して、好きなルートフォルダから各ページへのパスを設定できる
{
    return BASE_PATH . $path;
}

function view($path, $attributes = [])
{
    extract($attributes); //スコープ内に連想配列を変数としてインポートする
    require base_path('views/' . $path); 
}

function redirect($path) 
{
    header("location: {$path}");
    exit();
}

function old($key, $default = '') // 
{
    return Core\Session::get('old')['$key'] ?? $default;
}