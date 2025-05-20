<?php

use Illuminate\Support\Collection;

//require __DIR__."/../vendor/autoload.php";
//
//$numbers = new Collection([
//    1, 2, 3, 4, 5, 6, 7, 8, 9, 10
//]);
//
//$filtered = $numbers->filter(function ($number) {
//    return $number <= 5;
//});
//
//var_dump($filtered);

function string($string, $callback)
{
    $result = [
        'upper' => strtoupper($string),
        'lower' => strtolower($string)
    ];

    if (is_callable($callback)) {
        call_user_func($callback, $result);
    }
}

string('Test', function($name) {
    print_r($name);
});
//    echo string('Test', function ($name) {
//        echo $name['upper'];
//    });