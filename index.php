<?php

require 'functions.php'; //functions.phpを呼び出して、各関数をinvoke
require 'Database.php'; //DB操作に関わるphpファイルを読み込む
require 'Response.php'; //マジックナンバーを登録しているクラス
require 'router.php'; //最初に呼び出されるページなので、routerをinvoke


//$id = $_GET['id']; //クライアント側から送信されたクエリ URLの広報に"?<key>=<value>" と打ち込むと送信できる
//$query = "select * from posts where id = :id"; //SQL文 :idと表記したところは、$idの値が渡るようになっている。

//!!!!ユーザー側の入力(GET)内容が直接SQL分に挿入されることは絶対にないようにする!!!!!!
//!!!!$query = "select * from posts where id = {$id}"; ← ";drop user table等 送信されたらアウト"

//$posts = $db->query($query, [':id'=>$id])->fetch(); //query関数にSQL文を引数として渡し、メンバー関数のfetchAllを実行

//dd($posts);

