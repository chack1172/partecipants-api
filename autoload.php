<?php

// Autoload files for classes under App namespaces
spl_autoload_register(function ($class) {
    $prefix = 'App\\';
    $baseDir = __DIR__ . '/app/';

    $prefixLength = strlen($prefix);
    if (strncmp($prefix, $class, $prefixLength) !== 0) {
        return;
    }

    $relativeClass = substr($class, $prefixLength);

    $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';

    if (file_exists($file)) {
        require_once $file;
    }
});
