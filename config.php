<?php


return [ //dsnの元になる要素(DBに接続するためのキー)
    'database' => [
        'host' => 'localhost',
        'port' => '3306',
        'dbname' => 'myapp',
        'charset' => 'utf8mb4'
    ],
    //  他に環境ができたら追加する。
  
]; //グローバルスコープ配下にreturnを設定すると、当該phpファイルがrequestで呼び出された時に戻り値を渡すようになる。