<?php
use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$notes = $db->query('select * from notes where user_id = 1')->get();//user=id = 1 のデータを取得
//queryの戻り値がDatabaseインスタンスそのものになるので、メンバー式としてgetを呼び出せる(エラー扱い)

view('notes/index.view.php', [
    'heading' => 'My Notes',
    'notes' => $notes
]);