<?php
declare(strict_types=1);

namespace TopSoft4U\Connector\Methods\CreateSale;

use JsonSerializable;

class CreateSaleOwnLabelItem implements JsonSerializable
{
    public string $trackingNo;
    public ?string $url = null;
    public ?string $data = null;

    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        $result = [
            "tracking_no" => $this->trackingNo,
        ];

        if ($this->url !== null)
            $result["url"] = $this->url;

        if ($this->data !== null)
            $result["data"] = $this->data;

        return $result;
    }
}
