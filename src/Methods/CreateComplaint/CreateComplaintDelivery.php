<?php

namespace TopSoft4U\Connector\Methods\CreateComplaint;

use JsonSerializable;

class CreateComplaintDelivery implements JsonSerializable
{
    private int $fkShipmentType;
    public ?string $pickupPoint = null;

    public function __construct(int $fkShipmentType)
    {
        $this->fkShipmentType = $fkShipmentType;
    }

    public function jsonSerialize(): array
    {
        $result = [
            "fkshipmenttype" => $this->fkShipmentType,
        ];

        if ($this->pickupPoint !== null)
            $result["pickup_point"] = $this->pickupPoint;

        return $result;
    }
}
