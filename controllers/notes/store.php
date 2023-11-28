<?php

use Core\Validator;
use Core\App;
use Core\Database;

$db = App::resolve(Database::class); 

$errors = [];

if (! Validator::string($_POST['body'], 1, 1000)){ //bodyと最大値、最小値を確認
    $errors['body'] = 'A body of no more than 1,000 characters is required'; //
}

if (! empty($errors)){ 
    return view('notes/create.view.php', [
        'heading' => 'Create Note',
        'errors' => $errors
     ]);
}

$db->query('INSERT INTO notes(body, user_id) VALUES (:body, :user_id)', [//notesテーブルの2カラムに値を入力
    'body' => $_POST['body'], //プレイスホルダーを利用
    'user_id' => 1
]); //SQL文　GUIのDBに直接データを挿入すると、そのSQL文がHistory欄で確認できる。

header('location: /notes');
die();



 
