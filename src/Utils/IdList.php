<?php
declare(strict_types=1);

namespace TopSoft4U\Connector\Utils;

/**
 * List that ensures that all elements are integers and unique.
 */
class IdList implements \JsonSerializable
{
    /** @var int[] */
    private array $list = [];

    /**
     * @param array<int> $list
     */
    public function __construct(array $list)
    {
        foreach ($list as $item) {
            $this->Add($item);
        }
    }

    public function Add(int $item): void
    {
        if (in_array($item, $this->list, true))
            return;

        $this->list[] = $item;
    }

    public function Remove(int $item): void
    {
        $index = array_search($item, $this->list, true);
        if ($index === false)
            return;

        unset($this->list[$index]);
    }

    public function __toString(): string
    {
        return implode(",", $this->list);
    }

    public function jsonSerialize(): string
    {
        return implode(",", $this->list);
    }
}
