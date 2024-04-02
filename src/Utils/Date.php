<?php

namespace TopSoft4U\Connector\Utils;

use DateTime;

class Date
{
    public string $value;

    public function __construct(string $value)
    {
        $parts = explode("-", $value);
        if (count($parts) !== 3)
            throw new \InvalidArgumentException("Invalid date format - expected yyyy-MM-dd");

        if (!checkdate($parts[1], $parts[2], $parts[0]))
            throw new \InvalidArgumentException("Invalid date format - expected yyyy-MM-dd");

        $this->value = $value;
    }

    public static function FromDateTime(DateTime $dateTime): Date
    {
        return new Date($dateTime->format("Y-m-d"));
    }

    public static function FromYMD(int $year, int $month, int $day): Date
    {
        return new Date("$year-$month-$day");
    }

    public function __toString()
    {
        return $this->value;
    }
}
