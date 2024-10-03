<?php

// Function to list directories in the root of the project
function list_root_directories(): array
{
    $rootDir = __DIR__ . '/';  // Set to your project root
    $items = scandir($rootDir);

    // Filter to include only directories (excluding '.' and '..')
    return array_filter($items, function ($item) use ($rootDir) {
        return is_dir($rootDir . $item) && $item !== '.' && $item !== '..';
    });
}

// AutoLoader function to load classes from different directories
function my_autoLoader($className)
{
    $rootDir = __DIR__ . '/';  // Define the root directory (adjust if needed)
    $directories = list_root_directories();  // Get the directories in the root

    // $reflection_class = new \ReflectionClass($className);

    // $namespace = $reflection_class->getNamespaceName();

    // echo "<br>" . "namspace = " . $namespace . "<br>";

    foreach ($directories as $directory) {
        $file = $rootDir . $directory . '/' . $className . '.php';

        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }

    // Optional: Handle case where class is not found
    throw new Exception("Unable to load class: $className");
}

spl_autoload_register("my_autoLoader");
