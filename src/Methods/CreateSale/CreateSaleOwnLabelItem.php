<?php

namespace TopSoft4U\Connector\Methods\CreateSale;

use JsonSerializable;

class CreateSaleOwnLabelItem implements JsonSerializable
{
    public string $trackingNo;
    public ?string $url = null;
    public ?string $data = null;

    public function jsonSerialize()
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
