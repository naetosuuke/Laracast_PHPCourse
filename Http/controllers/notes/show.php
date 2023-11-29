<?php
use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$currentUserid = 1;


//POSTリクエストなら削除、それ以外はページ表示

$note = $db->query('select * from notes where id = :id',[
    'id' => $_GET['id']
])->findOrFail();

authorize($note['user_id'] === $currentUserid); //認証

view('notes/show.view.php', [
    'heading' => 'Note',
    'note' => $note
]);



