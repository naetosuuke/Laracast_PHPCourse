<?php
use Core\Container;

test('it can resolve something out of the container', function () {
    //arrange
    $container = new Container();

    $container->bind('foo', fn() => 'bar'); //アロー関数 クロージャの省略形 https://www.php.net/manual/ja/functions.arrow.php

    //act
    $result = $container->resolve('foo');

    //assert,expect
    expect($result)->toEqual('bar');
});
