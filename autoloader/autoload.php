<?php

/**
 * Custom autoload function to load classes based on their namespace.
 * 
 * This function is registered with `spl_autoload_register` to automatically load a class when it is instantiated.
 * It translates the fully qualified class name (including its namespace) into a file path, 
 * assuming that the directory structure mirrors the namespace hierarchy.
 *
 * The autoload:
 * - Replaces the backslashes (`\`) in the namespace with slashes (`/`) to construct the file path.
 * - Searches for the class file in the appropriate directory.
 *
 * Example:
 * For a class `App\Controllers\HomeController`, it will look for:
 * `/App/Controllers/HomeController.php`
 *
 * @param string $className The fully qualified class name with its namespace.
 * 
 * @throws Exception If the class file cannot be found in the expected location.
 */
spl_autoload_register(function ($className) {
    // Convert namespace separators into directory separators
    // Replace backslashes in the class name (namespace) with slashes for the file path
    $path = join("/", explode("\\", $className));

    // Construct the full file path where the class should reside
    $filePath = __DIR__ . '/' . $path . ".php";

    // Check if the class file exists, and include it if found
    if (file_exists($filePath)) {
        require_once $filePath;
    } else {
        // Throw an exception if the file cannot be found
        throw new Exception("Unable to load class: $className");
    }
});
