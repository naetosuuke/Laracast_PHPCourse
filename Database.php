<?php
class Database {
    public $connection; //DBとの接続セッションの格納先
    public $statement; //queryメソッドから届いたstatementを保管する

    public function __construct($config, $username = 'root', $password = '') //__construct内のプロパティ、メソッドはクラス初期化時に自動で実行される
    {
        $dsn = 'mysql:' . http_build_query($config,'', ';'); //host=localhost;port=3306;dbname=myapp.. と、configの要素をdsnに整形する。引数1がconfig,2がplefix(未使用),3がセパレータ(;)
        //$dsn =  "mysql:host={$config['host']};port={$config['port']};dbname={$config['dbname']};charset={$config['charset']}"; //data source name PDOに必要な情報を渡す

        $this->connection = new PDO($dsn, $username, $password , [ //DBの情報とユーザー名 pass, Optionを引数として渡し、DB接続する。$this はselfと同意語
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC //引数Optionの中で、PDOクラスのFETCH_MODEをASSOCIATEに設定している？
             //fetchAllの引数に入っているPDO::FETCH_ASSOCは、Staticプロパティ。Staticなので初期化せず呼出できる。
        ]); 
    }

    public function query($query, $params = []){ //queryとparams(id)を別々に入手
        $this->statement = $this->connection->prepare("$query"); // PDOのprepare関数にSQL文を渡す
        $this->statement->execute($params); //executeメソッドを実行　このタイミングでwhere句にわたすパラメーターを渡す
        return $this; //プロパティ上書き後のDatabaseクラスそのものを返している
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

