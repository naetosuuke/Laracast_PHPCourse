<?php

$config = require('config.php'); //config.phpの戻り値が$configに代入される
$db = new Database($config['database']); //DBクラスを初期化

$heading = 'My Notes';
    
$notes = $db->query('select * from notes where user_id = 1')->get();//DB上のnotesテーブルから、uswr=id = 1　のデータを取得
//queryの戻り値がDatabaseインスタンスそのものになるので、メンバー式としてgetを呼び出せる(エラー扱い)
//dd($notes);

require 'views/notes.view.php';