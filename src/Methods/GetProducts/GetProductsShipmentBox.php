<?php
declare(strict_types=1);

namespace TopSoft4U\Connector\Methods\GetProducts;

/**
 * Represents a single shipment box for a product.
 *
 * Replaces the deprecated top-level size_x / size_y / size_z fields on
 * GetProductsItem. Each entry is one shipping unit with its own dimensions
 * and gross weight.
 */
class GetProductsShipmentBox
{
    /** In cm */
    public float $sizeX;
    /** In cm */
    public float $sizeY;
    /** In cm */
    public float $sizeZ;
    /** In kg */
    public float $weightGross;

    /**
     * @param array<string, mixed> $data
     */
    public static function FromData(array $data): self
    {
        $item = new self();
        $item->sizeX = is_numeric($data["size_x"]) ? (float)$data["size_x"] : 0.0;
        $item->sizeY = is_numeric($data["size_y"]) ? (float)$data["size_y"] : 0.0;
        $item->sizeZ = is_numeric($data["size_z"]) ? (float)$data["size_z"] : 0.0;
        $item->weightGross = is_numeric($data["weightgross"]) ? (float)$data["weightgross"] : 0.0;

        return $item;
    }
}
