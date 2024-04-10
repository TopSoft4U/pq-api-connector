<?php

namespace TopSoft4U\Connector\Methods\GetProductMedia;

use TopSoft4U\Connector\Abstracts\GetMethod;

class GetProductMediaRequest extends GetMethod
{
    //region Query params
    private int $id;
    //endregion

    public function __construct(int $id)
    {
        if ($id <= 0)
            throw new \InvalidArgumentException("ID must be greater than 0");

        $this->id = $id;
    }

    public function getUrl(): string
    {
        return "/getProductMedia";
    }

    public function getQueryParams(): array
    {
        return [
            "id"         => $this->id,
        ];
    }

    public function formatData($data): GetProductMediaResponse
    {
        $result = new GetProductMediaResponse();
        foreach ($data as $row) {
            $result->items[] = GetProductMediaItem::FromData($row);
        }

        return $result;
    }
}
