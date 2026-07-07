<?php
declare(strict_types=1);

namespace TopSoft4U\Connector\Methods\GetProductsQty;

use TopSoft4U\Connector\Abstracts\PaginatedRequest;
use TopSoft4U\Connector\Utils\Currency;
use TopSoft4U\Connector\Utils\Date;

class GetProductsQtyRequest extends PaginatedRequest
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
    //endregion

    public function getUrl(): string
    {
        return "/getProductsQty";
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

        return $result;
    }

    public function formatData(array $data): GetProductsQtyResponse
    {
        $result = new GetProductsQtyResponse();
        foreach ($data as $row) {
            if (!is_array($row)) continue;
            /** @var array<string, mixed> $row */
            $result->items[] = GetProductsQtyItem::FromData($row);
        }

        return $result;
    }
}
