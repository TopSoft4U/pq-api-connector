<?php

namespace TopSoft4U\Connector\Methods\CreateComplaint;

use TopSoft4U\Connector\Abstracts\PostMethod;

class CreateComplaintRequest extends PostMethod
{
    private int $saleId;
    private int $type;
    private int $productId;
    private float $quantity;
    private string $description;

    private string $bankAccount;
    private string $swift;

    private array $pictures = [];

    public ?CreateComplaintReturnAddress $returnAddress = null;

    public ?CreateComplaintDelivery $delivery = null;

    /**
     * @throws \Exception
     */
    public function __construct(int $saleId, int $type, int $productId, float $quantity, string $description, string $bankAccount, string $swift)
    {
        if ($saleId <= 0)
            throw new \InvalidArgumentException("Sale ID must be greater than 0");

        if ($type <= 0)
            throw new \InvalidArgumentException("Type must be greater than 0");

        if ($productId < 0)
            throw new \InvalidArgumentException("Product ID must be greater than to 0. If you want mark complaint for whole sale - set it to 0");

        if ($quantity < 0)
            throw new \InvalidArgumentException("Quantity must be greater than 0");

        if (strlen($description) < 10)
            throw new \InvalidArgumentException("Description must be at least 10 characters long");

        if (strlen($bankAccount) < 12)
            throw new \InvalidArgumentException("Bank account must be at least 12 characters long");

        $this->saleId = $saleId;
        $this->type = $type;
        $this->productId = $productId;
        $this->quantity = $quantity;
        $this->description = $description;

        $this->bankAccount = $bankAccount;
        $this->swift = $swift;
    }

    public function getUrl(): string
    {
        return "/createComplaint";
    }

    public function getQueryParams(): array
    {
        return [];
    }

    public function getBodyData(): array
    {
        $result = [
            "saleid" => $this->saleId,
            "type" => $this->type,
            "productid" => $this->productId,
            "quantity" => $this->quantity,
            "description" => $this->description,
            "bankaccount" => $this->bankAccount,
            "swift" => $this->swift,
        ];

        if ($this->returnAddress)
            $result["return_address"] = $this->returnAddress;

        if ($this->delivery)
            $result["delivery"] = $this->delivery;

        return $result;
    }

    public function getFiles(): array
    {
        $result = [];

        foreach ($this->pictures as $index => $picture)
            $result["picture" . ($index + 1)] = $picture;

        return $result;
    }

    public function formatData($data)
    {
        return CreateComplaintResponse::FromData($data);
    }

    public function addPicture(\CURLFile $file)
    {
        if (count($this->pictures) >= 3)
            throw new \Exception("Maximum 3 pictures allowed");

        if (in_array($file, $this->pictures))
            throw new \Exception("Same picture cannot be added twice");

        $this->pictures[] = $file;
    }
}
