<?php

namespace Core;


class Session 
{
    public static function has($key) //鍵の有無　Boolで返す
    {
        return (bool) static::get($key);
    }

    public static function put($key, $value) //鍵に値を設定いる
    {
        $_SESSION[$key] = $value;
    }

    public static function get($key, $default = null) //鍵の取得、なかった場合の例外処理も設定できる
    {
        return $_SESSION['_flash'][$key] ?? $_SESSION[$key] ?? $default; //_flashキー用、通常キー用、例外用...とバニんディングをチェーンさせてる
    }

    public static function flash($key, $value) //一時的に(次回のロードまで)保持される値を設定する
    {
        $_SESSION['_flash'][$key] = $value;
    }

    public static function unflash()
    {
        unset($_SESSION['_flash']);
    }

    public static function flush() //$_SESSIONがもつ値を初期化
    {  
        $_SESSION =[];
    }

    public static function destroy() //現在のセッションを破棄(ログアウト)
    {  

        static::flush();
        session_destroy(); //現在のセッションに 関連づけられたすべてのデータを破棄(グローバル変数の中身は消せない)　https://www.php.net/manual/ja/function.session-destroy.php
    
        //ログアウト時、Cookieは削除するのでなく有効期限を失効させる
        $params = session_get_cookie_params();
        setcookie('PHPSESSID', '', time() - 3600, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
    }



}