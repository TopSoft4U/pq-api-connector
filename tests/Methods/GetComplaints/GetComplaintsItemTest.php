<?php

declare(strict_types=1);

namespace TopSoft4U\Connector\Tests\Methods\GetComplaints;

use PHPUnit\Framework\TestCase;
use TopSoft4U\Connector\Methods\GetComplaints\GetComplaintsItem;

class GetComplaintsItemTest extends TestCase
{
    public function testPicturesArrayIsNormalized(): void
    {
        $rows = json_decode(file_get_contents(__DIR__ . '/../../Fixtures/getComplaints.json'), true);
        $arrayPics = GetComplaintsItem::FromData($rows[0]);
        self::assertSame(
            ['https://example.com/pic1.png', 'https://example.com/pic2.png'],
            $arrayPics->pictures
        );

        $emptyPics = GetComplaintsItem::FromData($rows[1]);
        self::assertSame([], $emptyPics->pictures);  // empty-string normalized to []
    }

    public function testNullAndSingleStringPicturesAreNormalized(): void
    {
        $base = json_decode(file_get_contents(__DIR__ . '/../../Fixtures/getComplaints.json'), true)[0];

        $null = $base;
        $null['pictures'] = null;
        self::assertSame([], GetComplaintsItem::FromData($null)->pictures);

        $single = $base;
        $single['pictures'] = 'https://example.com/only.png';
        self::assertSame(['https://example.com/only.png'], GetComplaintsItem::FromData($single)->pictures);
    }
}
