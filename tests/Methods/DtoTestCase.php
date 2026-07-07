<?php

declare(strict_types=1);

namespace TopSoft4U\Connector\Tests\Methods;

use PHPUnit\Framework\TestCase;

/**
 * Base class for DTO tests. Provides a helper to load JSON fixtures that match
 * the real (lowercase-keyed) API response shapes documented in pq-www.
 */
abstract class DtoTestCase extends TestCase
{
    /**
     * Load and decode a fixture from tests/Fixtures.
     *
     * @return mixed
     */
    protected function loadFixture(string $name)
    {
        $path = __DIR__ . '/../Fixtures/' . $name;
        $contents = file_get_contents($path);
        if ($contents === false) {
            $this->fail("Fixture not found: $path");
        }

        return json_decode($contents, true);
    }
}
