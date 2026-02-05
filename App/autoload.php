<?php

// This code copied from https://www.php.net/manual/en/language.oop5.autoload.php#120258
// It is used to autoload classes in the App directory
spl_autoload_register(function ($class) {
    $baseDir = __DIR__ . '/';
    
    $relativeClass = str_replace('App\\', '', $class);

    $file = $baseDir . str_replace('\\', DIRECTORY_SEPARATOR, $relativeClass) . '.php';

    if (file_exists($file)) {
        require_once $file;
    }
});
