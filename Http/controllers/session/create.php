<?php

use Core\Session;

view('session/create.view.php', [
    'errors' => Session::get('errors') //リダイレクト直後に失効する
]);