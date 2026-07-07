<?php
declare(strict_types=1);

namespace TopSoft4U\Connector\Abstracts;

abstract class BaseRequest
{
    private const METHOD_TYPES_WITH_BODY = ["POST", "PUT", "PATCH"];

    abstract public function getUrl(): string;
    abstract public function getMethodType(): string;

    /**
     * @return array<string, mixed>
     */
    abstract public function getQueryParams(): array;

    /**
     * @return array<string, mixed>
     */
    abstract public function getBodyData(): array;

    /**
     * @param array<string, mixed> $data
     * @return mixed
     */
    abstract public function formatData(array $data);

    /**
     * Key = POST field name,
     * Value = CURLFile object
     *
     * @return \CURLFile[]
     */
    public function getFiles(): array
    {
        return [];
    }

    public function usesBody(): bool
    {
        return in_array($this->getMethodType(), self::METHOD_TYPES_WITH_BODY);
    }
}
