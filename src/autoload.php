<?php

declare(strict_types=1);

// Minimal PSR-4 autoloader for the TopSoft4U\Connector\ namespace.
//
// This lets the test suite (and the example scripts) run without a
// `composer install` step. In a normal composer-based project, composer's own
// vendor/autoload.php takes precedence and this file is simply not used.

spl_autoload_register(function (string $class): void {
    $prefix = 'TopSoft4U\\Connector\\';
    if (strncmp($class, $prefix, strlen($prefix)) !== 0) {
        return;
    }

    $relative = substr($class, strlen($prefix));
    $file = __DIR__ . '/' . str_replace('\\', '/', $relative) . '.php';
    if (is_file($file)) {
        require $file;
    }
});
