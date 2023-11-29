<?php

use Core\App;
use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class); //クラス初期化(コンテナ経由で起動)

$currentUserid = 1;

// find the corresponding note
$note = $db->query('select * from notes where id = :id',[
    'id' => $_POST['id']
])->findOrFail();


// authorization
authorize($note['user_id'] === $currentUserid);


// Validation
$errors =[];
if (! Validator::string($_POST['body'], 1, 1000)){ //bodyと最大値、最小値を確認
    $errors['body'] = 'A body of no more than 1,000 characters is required'; //
}

// update record in DB
if (count($errors)) {
    return view ('notes/edit/view/php', [
        'heading' => 'Edit Note',
        'errors' => $errors,
        'note' => $note    
    ]);
}
$db->query('update notes set body = :body where id = :id', [
    'id' => $_POST['id'],
    'body' => $_POST['body']
]);


// redirect
header('location: /notes');
die();
