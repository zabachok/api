<?php

namespace zabachok\api\helpers;

use DateTimeImmutable;
use DateTimeZone;
use Yii;

class DateHelper implements IDateHelper
{
    public static function getCurrentDate(): string
    {
        return date('Y-m-d H:i:s');
    }

    public function getTime(): int
    {
        return time();
    }

    public function getDateTimeFromMysqlDate(string $dateTime): DateTimeImmutable
    {
        return new DateTimeImmutable($dateTime, new DateTimeZone(Yii::$app->timeZone));
    }
}
