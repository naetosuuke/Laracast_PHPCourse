<?php


session_start(); 

const BASE_PATH = __DIR__ . '/../'; //BASE_PATHは現在の1つ上のディレクトリ
require BASE_PATH . 'Core/functions.php';

spl_autoload_register(function ($class){ //コンパイル時、宣言されていないクラスをみつけたら名前を返す(=自動ロードのトリガー)
    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class); // "Core\クラス名" のバックスラッシュを置換
    require base_path("{$class}.php"); //ここでDatabase, Responseクラスを呼び出している
});

require base_path('bootstrap.php'); //service conainerのセットアップ



$router = new \Core\Router(); 
$routes = require base_path('routes.php');

$uri = parse_url($_SERVER['REQUEST_URI'])['path']; //urlのpath要素を取得
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD']; //POST=nullの例外分岐

$router->route($uri, $method);

