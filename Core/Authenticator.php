<?php

namespace Core;

class Authenticator
{
    public function attempt($email, $password)
    {
        //Find user and throw error if submitted data doesn't exist in DB
        $user = App::resolve(Database::class)->query('select * from users where email = :email', [
            'email' => $email
        ])->find();

        if ($user) {
                //password verification and grant login session
            if (password_verify($password, $user['password'])){
                $this->login([
                    'email' => $email
                ]);
                return true;

            }
        }
        return false;
    }

    public function login($user)
    {
        $_SESSION['user'] = [
            'email' => $user['email']
        ];
        session_regenerate_id(true); //現在のセッションに新しいIDを付与し直す関数 引数boolで古いIDを削除するか決める
    }
    
    public function logout()
    {
        Session::destroy(); //グローバル変数の中身を空にする
    }
}

