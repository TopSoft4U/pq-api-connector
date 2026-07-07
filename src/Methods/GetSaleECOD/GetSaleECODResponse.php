<?php
declare(strict_types=1);

namespace TopSoft4U\Connector\Methods\GetSaleECOD;

class GetSaleECODResponse
{
    public ?string $content = null;

    /**
     * @param array<string, mixed> $data
     */
    public static function FromData(array $data): self
    {
        $item = new self();
        $item->content = is_string($data["content"] ?? null) ? $data["content"] : null;
        return $item;
    }
}
