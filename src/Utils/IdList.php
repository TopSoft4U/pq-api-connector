<?php

namespace TopSoft4U\Connector\Utils;

/**
 * List that ensures that all elements are integers and unique.
 */
class IdList
{
    private array $list = [];

    public function __construct(array $list)
    {
        foreach ($list as $item) {
            $this->Add($item);
        }
    }

    public function Add(int $item)
    {
        if (in_array($item, $this->list))
            return;

        $this->list[] = $item;
    }

    public function Remove(int $item)
    {
        $index = array_search($item, $this->list);
        if ($index === false)
            return;

        unset($this->list[$index]);
    }

    public function __toString()
    {
        return implode(",", $this->list);
    }
}
