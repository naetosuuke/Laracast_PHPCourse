<?php

namespace Core;

use Core\Middleware\Middleware;

class Router
{
    protected $routes = []; //このクラス、インスタンス内でのみ呼出可能 

    public function add($method, $uri, $controller)
    {
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => $method,
            'middleware' => null
        ];
        //compact('method', 'uri', 'controller')　を使うと、キーと変数が同じ名前の連想配列を生成できる。(上と一緒)
        return $this;

    }

    public function get($uri, $controller)
    {
        return $this->add('GET', $uri, $controller);
    }

    public function post($uri, $controller)
    {
        return $this->add('POST', $uri, $controller);
    }

    public function delete($uri, $controller)
    {
        return $this->add('DELETE', $uri, $controller);
    }

    public function patch($uri, $controller)
    {
        return $this->add('PATCH', $uri, $controller);
    }

    public function put($uri, $controller)
    {
        return $this->add('PUT', $uri, $controller);
    }

    public function only($key)
    {
        $this->routes[array_key_last($this->routes)]['middleware'] = $key;
        
        return $this;
    }

    public function route($uri, $method) //routesとuri,またリクエストメソッドが合致すればページ表示、しなければ404
    {
        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] === strtoupper($method)) { //strtoupper:文字列を大文字にする

                //middlewareが値を持つページにアクセスする際は、DIコンテナを利用して認証状態によってリダイレクト処理がされる
                Middleware::resolve($route['middleware']);
                    
                //controllerはすべてcontrollers配下にあるので、先にパスを補完
                return require base_path('Http/controllers/' . $route['controller']);
            }
        }

        $this->abort(); 
    }

    public function previousUrl()
    {
        return $_SERVER['HTTP_REFERER'] ; //HTTPリクエストを送った時のURIが格納されてる
    }


    protected function abort($code = 404){ //初期値 404
        http_response_code($code); //404コードを返す(クライアント側への通知)
        require base_path("views/{$code}.php");
        die();
    }
}




