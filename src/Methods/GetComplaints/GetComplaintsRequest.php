<?php

namespace TopSoft4U\Connector\Methods\GetComplaints;

use TopSoft4U\Connector\Abstracts\GetRequest;
use TopSoft4U\Connector\Utils\Date;

class GetComplaintsRequest extends GetRequest
{
    public ?array $id = null;
    public ?Date $modified = null;
    public ?string $name = null;
    public ?array $saleId = null;
    public ?array $productId = null;
    public ?array $complaintStatusId = null;
    public ?array $complaintReasonId = null;

    public function getUrl(): string
    {
        return "/getComplaints";
    }

    public function getQueryParams(): array
    {
        $result = [];
        if ($this->id !== null)
            $result["id"] = $this->id;

        if ($this->modified !== null)
            $result["modified"] = $this->modified;

        if ($this->name !== null)
            $result["name"] = $this->name;

        if ($this->saleId !== null)
            $result["saleid"] = $this->saleId;

        if ($this->productId !== null)
            $result["productid"] = $this->productId;

        if ($this->complaintStatusId !== null)
            $result["complaintstatusid"] = $this->complaintStatusId;

        if ($this->complaintReasonId !== null)
            $result["complaintreasonid"] = $this->complaintReasonId;

        return $result;
    }

    public function formatData($data)
    {
        $result = new GetComplaintsResponse();
        foreach ($data as $row) {
            $result->items[] = GetComplaintsItem::FromData($row);
        }

        return $result;
    }
}
