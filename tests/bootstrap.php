<?php

declare(strict_types=1);

// Test bootstrap. Registers the src/ autoloader so the test suite runs without
// needing `composer install` (the package has no production dependencies, only
// ext-curl and ext-json).

require __DIR__ . '/../src/autoload.php';
