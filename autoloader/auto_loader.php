<?php
spl_autoload_register(function ($className) {
    [$dir, $filename] = explode("\\", $className);
    $fullPath = __DIR__ . '/' . $dir . '/' . $filename . ".php";
    if (file_exists($fullPath)) require_once $fullPath;
    else throw new Exception("Unable to load class: $className");
});
