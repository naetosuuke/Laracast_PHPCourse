<?php
use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$currentUserid = 1;

$note = $db->query('select * from notes where id = :id',[
    'id' => $_POST['id']
])->findOrFail();//DB上のnotesテーブルから、uswr=id = 1　のデータを取得

authorize($note['user_id'] === $currentUserid); //認証

$db->query('delete from notes where id = :id', [ //削除を行うSQL文
    'id' => $_GET['id'] //POSTが認識できないブラウザを想定し、GETで操作できる実装にした
]);

header('location: /notes'); //HTTPヘッダーを指定(リクエスト先を書き換える)
exit();
