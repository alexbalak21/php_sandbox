<?php

/**
 * Custom autoload function to load classes based on their namespace using namespace as folder path.
 * 
 * This function registers an anonymous function with `spl_autoload_register` 
 * that automatically loads a class when it's instantiated by translating 
 * the class namespace into a file path.
 *
 * - Assumes a directory structure where namespaces map to directories.
 * - Converts the namespace separator (`\`) into a directory separator (`/`).
 * - The class file should be located in the corresponding directory.
 *
 * Example:
 * For class `App\Controllers\HomeController`, the autoloader will look for:
 * `/App/Controllers/HomeController.php`
 *
 * @param string $className The fully qualified class name with namespace.
 * 
 * @throws Exception If the class file cannot be found.
 */
spl_autoload_register(function ($className) {
    // Split the namespace and class name based on the backslash `\` separator
    [$dir, $filename] = explode("\\", $className);

    // Construct the full file path based on the class's namespace and filename
    $fullPath = __DIR__ . '/' . $dir . '/' . $filename . ".php";

    // Check if the file exists, if so, include it; otherwise, throw an exception
    if (file_exists($fullPath)) {
        require_once $fullPath;
    } else {
        throw new Exception("Unable to load class: $className");
    }
});
