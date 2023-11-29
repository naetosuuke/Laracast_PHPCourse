<?php 

namespace Http\Forms;

use Core\ValidationException;
use Core\Validator;

class LoginForm
{
    protected  $errors = [];

    public function __construct(public array $attributes) //初期化された時点でValidationが行われる。かつ、引数をとりながらクラス内のプロパティとして宣言している(PHP8以降の機能)
    {
        // varidation
        if (! Validator::email($attributes['email'])){
            $this->errors['email'] = 'Please provide a valid email address.';
        }
        if (! Validator::string($attributes['password'])){ //最小7, 最大255字
            $this->errors['password'] = 'Please provide a valid password';
        }
        return empty($errors);
    }

    public static function validate($attributes)
    {
        $instance = new static($attributes);

        return $instance->failed() ? $instance->throw() : $instance;

        if($instance->failed()){
        $instance->throw();

        }
        return $instance; //バリデーション後のAttributeを返す
    }

    public function throw()
    {
        // throw new ValidationException();
        ValidationException::throw($this->errors(), $this->attributes);
    }

    public function failed() 
    {

        return count($this->errors());
    }

    public function errors() //$errorsはprotectedなので、メンバー式では参照不可 呼び出したい時だけ関数で出力させる
    {
        return $this->errors;
    }

    public function error($field, $message) //$errorsにエラーメッセージを登録、$fieldと本文をアサイン
    {
        $this->errors[$field] = $message;
        return $this;
    }


}