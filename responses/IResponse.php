<?php

namespace zabachok\api\responses;

interface IResponse
{
    public function getContent(): array;
    public function getApplicationCode(): int;
    public function getHttpCode(): int;
}
