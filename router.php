<?php

//このファイルがルーターとして機能する

$routes = require('routes.php');//ルート情報は別ファイルからinvoke

$uri = parse_url($_SERVER['REQUEST_URI'])['path']; //urlのpath要素を取得　Uniform Resource Identifier


function routeToController($uri, $routes) { 

    if (array_key_exists($uri, $routes)) { ; //引数1が引数2に含まれているかをboolで返す
    require $routes[$uri]; //$uriに応じたコントローラーを起動
    } else { //存在しないページにアクセスしようとしたら
        abort(); //通知+ページ表示
    }
}

function abort($code = 404){ //初期値 404
    http_response_code($code); //404コードを返す(クライアント側への通知)
    require "views/{$code}.php";
    die();
}


routeToController($uri, $routes);
