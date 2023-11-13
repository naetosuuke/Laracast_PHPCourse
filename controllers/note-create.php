<?php

require 'Validator.php';

$config = require 'config.php'; //config.phpの戻り値が$configに代入される
$db = new Database($config['database']); //DBクラスを初期化

$heading = 'Create Note';

$identifier = ($_SERVER['REQUEST_METHOD']);
if ($identifier === 'POST') { //要求メソッドがPOSTなら
   $errors = [];
   //$validator = new Validator(); Staticメソッドを使っているので初期化不要

   if (! Validator::string($_POST['body'], 1, 1000)){ //validationに、bodyと最大値、最小値を渡している
      $errors['body'] = 'A body of no more than 1,000 characters is required'; //
   }

   if (empty($errors)){ //errorがない時だけクエリ送信
      $db->query('INSERT INTO notes(body, user_id) VALUES (:body, :user_id)', [//query 第2引数で要素を追加することでSQLインジェクションを回避
         'body' => $_POST['body'],
         'user_id' => 1
      ]); //SQL文　GUIのDBに直接データを挿入すると、そのSQL文がHistory欄で確認できる。
   }
}



//このままだとDB上に保存するデータにHTMLタグを仕込まれ、デカ文字やJS呼び出しを食らうことになる
//example... <h1 style="font-size:100px">Ah ah ah...</h1><script>alert('Hi FROM JS')</script>

require 'views/note-create.view.php';
