<?php

declare(strict_types=1);

namespace TopSoft4U\Connector\Tests\Methods\GetAccountData;

use PHPUnit\Framework\TestCase;
use TopSoft4U\Connector\Methods\GetAccountData\GetAccountDataResponse;

class GetAccountDataResponseTest extends TestCase
{
    public function testFromDataMapsCurrency(): void
    {
        $data = json_decode(file_get_contents(__DIR__ . '/../../Fixtures/getAccountData.json'), true);
        $item = GetAccountDataResponse::FromData($data);

        self::assertSame('PLN', $item->currency);
        self::assertSame('Test Account', $item->name);
        self::assertSame('PL', $item->countryInvoice);
        self::assertSame('PL', $item->countrySend);
        self::assertSame('test@example.com', $item->email);
    }
}
