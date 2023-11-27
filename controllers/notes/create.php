<?php

use Core\Database; //名前空間を利用してインポートしている(requireの代わり)
use Core\Validator;

$config = require base_path('config.php'); //config.phpの戻り値が$configに代入される
$db = new Database($config['database']); //DBクラスを初期化
$errors = [];

$identifier = ($_SERVER['REQUEST_METHOD']);
if ($identifier === 'POST') { //要求メソッドがPOSTなら
   if (! Validator::string($_POST['body'], 1, 1000)){ //bodyと最大値、最小値を確認
      $errors['body'] = 'A body of no more than 1,000 characters is required'; //
   }

   if (empty($errors)){ //errorがない時だけクエリ送信
      $db->query('INSERT INTO notes(body, user_id) VALUES (:body, :user_id)', [//notesテーブルの2カラムに値を入力
         'body' => $_POST['body'], //プレイスホルダーを利用
         'user_id' => 1
      ]); //SQL文　GUIのDBに直接データを挿入すると、そのSQL文がHistory欄で確認できる。
   }
}



//このままだとDB上に保存するデータにHTMLタグを仕込まれ、デカ文字やJS呼び出しを食らうことになる
//example... <h1 style="font-size:100px">Ah ah ah...</h1><script>alert('Hi FROM JS')</script>

view('notes/create.view.php', [
   'heading' => 'Create Note',
   'errors' => $errors
]);
