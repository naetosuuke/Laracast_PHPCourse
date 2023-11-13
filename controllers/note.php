<?php

$config = require('config.php'); //config.phpの戻り値が$configに代入される
$db = new Database($config['database']); //DBクラスを初期化

$heading = 'Note';
$currentUserid = 1;

//前の画面から渡されたidを、SQL分にバインディングしながら渡す
$note = $db->query('select * from notes where id = :id',[
    'id' => $_GET['id']
])->findOrFail();//DB上のnotesテーブルから、uswr=id = 1　のデータを取得
//queryの戻り値がDatabaseインスタンスそのものになるので、メンバー式としてfindOrFailを呼び出せる(エラー扱い)
authorize($note['user_id'] === $currentUserid);

require 'views/note.view.php';