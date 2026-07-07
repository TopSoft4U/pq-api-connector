<?php
declare(strict_types=1);

namespace TopSoft4U\Connector\Methods\CreateSale;

use JsonSerializable;

class CreateSaleOwnLabel implements JsonSerializable
{
    public CreateSaleOwnLabelMode $mode;
    public string $provider;

    /**
     * @var \TopSoft4U\Connector\Methods\CreateSale\CreateSaleOwnLabelItem[]
     */
    public array $items = [];

    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        $result = [
            "mode" => $this->mode,
            "provider" => $this->provider,
        ];

        $items = [];
        foreach ($this->items as $label) {
            $item = [
                "tracking_no" => $label->trackingNo,
            ];

            if ((string) $this->mode == (string) CreateSaleOwnLabelMode::PDF())
                $item["data"] = $label->data;
            else if ((string) $this->mode == (string) CreateSaleOwnLabelMode::URL())
                $item["url"] = $label->url;

            $items[] = $item;
        }
        $result["items"] = $items;

        return $result;
    }
}
