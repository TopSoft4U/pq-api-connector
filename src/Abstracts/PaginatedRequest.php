<?php
declare(strict_types=1);

namespace TopSoft4U\Connector\Abstracts;

/**
 * Base class for GET endpoints that support server-side pagination.
 *
 * Both $limit and $page are optional and NOT enforced client-side.
 * The API caps $limit at 1000 and requires $page >= 1; those constraints
 * are validated by the server, not here.
 *
 * Subclasses implement {@see getOwnQueryParams()} with their endpoint-specific
 * query parameters. The merged result (own params + pagination) is returned by
 * the final {@see getQueryParams()}.
 */
abstract class PaginatedRequest extends GetRequest
{
    /** @var int|null Maximum number of items per page. Server caps this at 1000. */
    public ?int $limit = null;

    /** @var int|null Page number (1-based). Must be >= 1. */
    public ?int $page = null;

    /**
     * Endpoint-specific query parameters (without pagination).
     *
     * @return array<string, mixed>
     */
    abstract protected function getOwnQueryParams(): array;

    /**
     * Final: merges own query params with optional pagination.
     *
     * @return array<string, mixed>
     */
    final public function getQueryParams(): array
    {
        $params = $this->getOwnQueryParams();

        if ($this->limit !== null)
            $params['limit'] = $this->limit;

        if ($this->page !== null)
            $params['page'] = $this->page;

        return $params;
    }
}
