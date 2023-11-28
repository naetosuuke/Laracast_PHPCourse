<?php

use Core\App;
use Core\Container;
use Core\Database;

$container = new Container(); 

$container->bind('Core\Database', function(){ //DBクラスの名前空間をキー、初期化関数を値として連想配列に保存
    $config = require base_path('config.php');
    return new Database($config['database']); 
});

App::setContainer($container); //コンテナをシングルトンクラスに渡して永続化


