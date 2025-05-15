<?php

use Core\Container;

test('example', function () {
    // setup
    $container = new Container();

    $container->bind('foo', function (){
        return 'bar';
    });

    // code
    $result = $container->resolve('foo');

    // assert
    expect($result)->toEqual('bar');
});
