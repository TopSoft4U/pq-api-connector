<?php

declare(strict_types=1);

namespace TopSoft4U\Connector\Tests\Methods\CreateComplaint;

use PHPUnit\Framework\TestCase;
use TopSoft4U\Connector\Methods\CreateComplaint\CreateComplaintRequest;

class CreateComplaintRequestTest extends TestCase
{
    public function testBodyUsesQtyKeyNotQuantity(): void
    {
        $request = new CreateComplaintRequest(
            1,
            3,
            45356,
            2.0,
            'Defective product please replace',
            'PL60102010263000401111000000',
            'BPKOPLPW'
        );

        $body = $request->getBodyData();

        // API expects `qty`, not `quantity`
        self::assertArrayHasKey('qty', $body);
        self::assertArrayNotHasKey('quantity', $body);
        self::assertSame(2.0, $body['qty']);
    }
}
