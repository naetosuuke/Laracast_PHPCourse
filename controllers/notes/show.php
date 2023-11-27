<?php
use Core\Database;

$config = require base_path('config.php');//config.phpの戻り値が$configに代入される
$db = new Database($config['database']); //DBクラスを初期化

$currentUserid = 1;


//POSTリクエストなら削除、それ以外はページ表示

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $note = $db->query('select * from notes where id = :id',[
        'id' => $_GET['id']
    ])->findOrFail();//DB上のnotesテーブルから、uswr=id = 1　のデータを取得

    authorize($note['user_id'] === $currentUserid); //認証

    $db->query('delete from notes where id = :id', [ //削除を行うSQL文
        'id' => $_GET['id'] //POSTが認識できないブラウザを想定し、GETで操作できる実装にした
    ]);

    header('location: /notes'); //HTTPヘッダーを指定(リクエスト先を書き換える)
    exit();

} else {
    $note = $db->query('select * from notes where id = :id',[
        'id' => $_GET['id']
    ])->findOrFail();
    authorize($note['user_id'] === $currentUserid); //認証
    
    view('notes/show.view.php', [
        'heading' => 'Note',
        'note' => $note
    ]);

}


