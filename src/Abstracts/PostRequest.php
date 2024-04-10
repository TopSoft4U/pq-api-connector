<?php

namespace TopSoft4U\Connector\Abstracts;

abstract class PostRequest extends BaseRequest
{
    public function getMethodType(): string
    {
        return "POST";
    }
}
