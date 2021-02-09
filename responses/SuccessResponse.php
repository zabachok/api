<?php

namespace zabachok\api\responses;

abstract class SuccessResponse implements IResponse
{
    public function getContent(): array
    {
        return [
            'code' => $this->getApplicationCode(),
            'data' => $this->getData(),
        ];
    }

    public function getApplicationCode(): int
    {
        return 0;
    }

    public function getHttpCode(): int
    {
        return 200;
    }

    abstract public function getData(): array;
}
