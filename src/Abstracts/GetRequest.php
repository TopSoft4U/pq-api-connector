<?php
declare(strict_types=1);

namespace TopSoft4U\Connector\Abstracts;

abstract class GetRequest extends BaseRequest
{
    public function getMethodType(): string
    {
        return "GET";
    }

    /**
     * @return array<string, mixed>
     */
    public function getBodyData(): array
    {
        return [];
    }
}
