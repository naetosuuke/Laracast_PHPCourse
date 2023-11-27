<?php

namespace Core;

use PDO; //PDOファイルはrootディレクトリ配下にある。明示的に場所を指名しないとCore配下から参照しようとする



class Database {
    public $connection; //DBとの接続セッションの格納先
    public $statement; //queryメソッドから届いたstatementを保管する

    public function __construct($config, $username = 'root', $password = '') //__construct クラス初期化時に自動で実行　
    {
        $dsn = 'mysql:' . http_build_query($config,'', ';'); //host=localhost;port=3306;dbname=myapp.. と、configの要素をdsnに整形する。引数1がconfig,2がplefix(未使用),3がセパレータ(;)

        $this->connection = new PDO($dsn, $username, $password , [ //接続文字列と認証情報, Optionを引数として渡し、DB接続する。
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC //FETCH_MODEをASSOCIATEに設定 こうしないとキーと値が別々に出力される
        ]); 
    }

    public function query($query, $params = []){ //queryとparams(id)を別々に入手
        $this->statement = $this->connection->prepare("$query"); // PDOのprepare関数にSQL文を渡す
        $this->statement->execute($params); //executeメソッドを実行　where句にわたすパラメーター(記事id)を渡す
        return $this; //インスタンスの上書き
    }

    public function get() {
        return $this->statement->fetchAll();
    }


    public function find(){
        return $this->statement->fetch();//
    }

    public function findOrFail(){
        $result = $this->find();
        if(! $result){ //fetchしたデータが空のとき（false）
            abort(); //ページなしと表示
        }
        return $result;
    }
}   

