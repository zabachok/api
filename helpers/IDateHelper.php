<?php

namespace zabachok\api\helpers;

use DateTimeImmutable;

interface IDateHelper
{
    public function getTime(): int;

    public function getDateTimeFromMysqlDate(string $dateTime): DateTimeImmutable;
}
