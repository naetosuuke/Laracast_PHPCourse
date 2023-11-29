<?php

use Core\App;
use Core\Database;
use Core\Validator;
use Core\Authenticator;

$email = $_POST['email'];
$password = $_POST['password'];

$db = App::resolve(Database::class);

$errors = [];

// varidation
if (!Validator::email($email)){
    $errors['email'] = 'Please provide a valid email address.';
}
if (!Validator::string($password, 7, 255)){ //最小7, 最大255字
    $errors['password'] = 'Please provide a passwordat least 7 and up to 255 chars.';
}
if (! empty($errors)){
    return view('registration/create.view.php', [
        'errors' => $errors
    ]);
}

//DBに接続、重複を検索

$user = $db->query('select * from users where email = :email', [
    'email' => $email
])->find(); 

if ($user) { //DBに登録があれば、ログイン画面にリダイレクト
    header('location: /');
    exit(); //ヘッダーを送信した後はプロセスをkillする癖をつけたほうがいい

} else { //登録、ログイン中とセッションに記録
    $db->query('INSERT INTO users(email, password) VALUES(:email, :password)',[ 
        'email' => $email,
        'password' => password_hash($password, PASSWORD_BCRYPT) // 絶対に平文でパスを送らないこと
    ]);

    $auth = new Authenticator;
    $auth->login($user);

    header('location: /');
    exit();
}