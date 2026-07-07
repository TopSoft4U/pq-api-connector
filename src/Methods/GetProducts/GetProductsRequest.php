<?php
declare(strict_types=1);

namespace TopSoft4U\Connector\Methods\GetProducts;

use TopSoft4U\Connector\Abstracts\PaginatedRequest;
use TopSoft4U\Connector\Utils\Currency;
use TopSoft4U\Connector\Utils\Date;

class GetProductsRequest extends PaginatedRequest
{
    //region Query params
    /** @var int[]|null */
    public ?array $id = null;
    public ?string $name = null;
    public ?string $pid = null;
    public ?string $ean = null;
    /** @var int[]|null */
    public ?array $productCategoryId = null;
    public ?Date $modified = null;
    public ?Currency $currency = null;

    public ?bool $adult = null;
    public ?bool $gpsrReady = null;
    public ?int $leadTime = null;

    // Dimension/weight filters (longest edge in cm, weight in kg)
    public ?float $longestEdgeAbove = null;
    public ?float $longestEdgeBelow = null;
    public ?float $weightGrossAbove = null;
    public ?float $weightGrossBelow = null;

    // Price filters (net or gross, in account or $currency)
    public ?float $userPriceNetAbove = null;
    public ?float $userPriceNetBelow = null;
    public ?float $userPriceGrossAbove = null;
    public ?float $userPriceGrossBelow = null;
    //endregion

    public function getUrl(): string
    {
        return "/getProducts";
    }

    protected function getOwnQueryParams(): array
    {
        $result = [];

        if ($this->id !== null)
            $result['id'] = $this->id;

        if ($this->name !== null)
            $result['name'] = $this->name;

        if ($this->pid !== null)
            $result['pid'] = $this->pid;

        if ($this->ean !== null)
            $result['ean'] = $this->ean;

        if ($this->productCategoryId !== null)
            $result['productcategoryid'] = $this->productCategoryId;

        if ($this->modified !== null)
            $result['modified'] = $this->modified;

        if ($this->currency !== null)
            $result['currency'] = $this->currency;

        if ($this->adult !== null)
            $result['adult'] = $this->adult;

        if ($this->gpsrReady !== null)
            $result['gpsr_ready'] = $this->gpsrReady;

        if ($this->leadTime !== null)
            $result['leadtime'] = $this->leadTime;

        if ($this->longestEdgeAbove !== null)
            $result['longest_edge_above'] = $this->longestEdgeAbove;

        if ($this->longestEdgeBelow !== null)
            $result['longest_edge_below'] = $this->longestEdgeBelow;

        if ($this->weightGrossAbove !== null)
            $result['weight_gross_above'] = $this->weightGrossAbove;

        if ($this->weightGrossBelow !== null)
            $result['weight_gross_below'] = $this->weightGrossBelow;

        if ($this->userPriceNetAbove !== null)
            $result['user_price_net_above'] = $this->userPriceNetAbove;

        if ($this->userPriceNetBelow !== null)
            $result['user_price_net_below'] = $this->userPriceNetBelow;

        if ($this->userPriceGrossAbove !== null)
            $result['user_price_gross_above'] = $this->userPriceGrossAbove;

        if ($this->userPriceGrossBelow !== null)
            $result['user_price_gross_below'] = $this->userPriceGrossBelow;

        return $result;
    }

    public function formatData(array $data): GetProductsResponse
    {
        $result = new GetProductsResponse();
        foreach ($data as $row) {
            if (!is_array($row)) continue;
            /** @var array<string, mixed> $row */
            $result->items[] = GetProductsItem::FromData($row);
        }

        return $result;
    }
}
