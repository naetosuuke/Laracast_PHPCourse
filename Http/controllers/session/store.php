<?php

// log in the user if the 
use Core\Authenticator;
use Http\Forms\LoginForm;

// validation
$form = LoginForm::validate($attributes = [ //先に__constructが実行された後、validateメソッド実行
'email' => $_POST['email'],
'password' => $_POST['password']
]);

// authentication check
$SignedIn = (new Authenticator)->attempt($attributes['email'], $attributes['password']); 
if (!$SignedIn) { 
$form->error('email', 'No maching account fond for that email address and password')->throw(); //LoginFormクラスで預かってるエラー文に追加し、routerのCatchに投げる。
}

redirect('/'); //成功した場合、ここで処理が止まる