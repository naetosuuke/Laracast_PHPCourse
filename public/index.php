<?php

use Core\Session;
use Core\ValidationException;

session_start(); 

const BASE_PATH = __DIR__ . '/../'; // BASE_PATHは現在の1つ上のディレクトリ
require BASE_PATH . 'vendor/autoload.php'; //composerに入ってるautoload 必ず最初にインポート



// ここで設定したautoloadの仕組みは、composer　installで入手できるautoloadを用いて、上記の用事に実装できる。
// spl_autoload_register(function ($class){ //コンパイル時、宣言されていないクラスをみつけたら名前を返す(=自動ロードのトリガー)
//     $class = str_replace('\\', DIRECTORY_SEPARATOR, $class); // "Core\クラス名" のバックスラッシュを置換
//     require base_path("{$class}.php"); //ここでDatabase, Responseクラスを呼び出している
// });


require BASE_PATH . 'Core/functions.php';


require base_path('bootstrap.php'); //service conainerのセットアップ

$router = new \Core\Router(); 
$routes = require base_path('routes.php');

$uri = parse_url($_SERVER['REQUEST_URI'])['path']; //urlのpath要素を取得
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD']; //POST=nullの例外分岐


//例外をキャッチしたら、エラー文とPostリクエストで送ったemail情報を一時的に保存
try{
    $router->route($uri, $method);
} catch (ValidationException $exception) {
    Session::flash('errors', $exception->errors);
    Session::flash('old', $exception->old);

    return redirect($router->previousUrl());
}

Session::unflash(); //全てのコードが実行された後、_flash配下のクッキーを削除せる。(flash配下で配列を持てば、flashさえ消せば全て削除できる。)
