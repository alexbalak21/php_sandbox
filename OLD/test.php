<?php

use function PHPSTORM_META\type;

class User
{
    public  $name = "alex";
}

$user = new User;


function wrapper(object $var)
{
    $str = print_r($var, true);
    $str = json_encode($str);
    $str = substr($str, 62, -1);
    $str = str_replace([')', ' ', '[', ']', '=', '\n', '$'], ['', '', '', '', '', '', ''], $str);
    $arr = explode('>', $str);
    var_dump($arr);
    var_dump($str);
}

$inner = function ($hello, $world, $bed, $tired, $ofthisshit) {
    echo "Hi";
};

wrapper($inner);
