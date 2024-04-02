<?php

namespace TopSoft4U\Connector\Methods\GetAccountData;

use TopSoft4U\Connector\Abstracts\GetMethod;

class GetAccountDataRequest extends GetMethod
{
    public function getUrl(): string
    {
        return "/getAccountData";
    }

    public function getQueryParams(): array
    {
        return [];
    }

    public function formatData($data): GetAccountDataResponse
    {
        return GetAccountDataResponse::FromData($data);
    }
}
