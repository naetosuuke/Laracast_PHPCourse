<?php

use Core\Database;

$config = require base_path('config.php');//config.phpの戻り値が$configに代入される
$db = new Database($config['database']); //DBクラスを初期化 namespaceを使用
    
$notes = $db->query('select * from notes where user_id = 1')->get();//user=id = 1 のデータを取得
//queryの戻り値がDatabaseインスタンスそのものになるので、メンバー式としてgetを呼び出せる(エラー扱い)

view('notes/index.view.php', [
    'heading' => 'My Notes',
    'notes' => $notes
]);