<?php

namespace TopSoft4U\Connector\Abstracts;

abstract class PostMethod extends BaseMethod
{
    public function getMethodType(): string
    {
        return "POST";
    }
}
