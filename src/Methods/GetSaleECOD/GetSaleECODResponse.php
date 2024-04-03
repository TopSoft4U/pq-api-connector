<?php

namespace TopSoft4U\Connector\Methods\GetSaleECOD;

class GetSaleECODResponse
{
    public ?string $content = null;

    public static function FromData(array $data): self
    {
        $item = new self();
        $item->content = $data["content"] ?? null;
        return $item;
    }
}
