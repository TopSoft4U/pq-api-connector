<?php
declare(strict_types=1);

namespace TopSoft4U\Connector\Methods\GetAccountData;

use TopSoft4U\Connector\Abstracts\GetRequest;

class GetAccountDataRequest extends GetRequest
{
    public function getUrl(): string
    {
        return "/getAccountData";
    }

    public function getQueryParams(): array
    {
        return [];
    }

    public function formatData(array $data): GetAccountDataResponse
    {
        return GetAccountDataResponse::FromData($data);
    }
}
