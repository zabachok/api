<?php

namespace zabachok\api\responses;

use yii\web\Response;

class ApiResponse extends Response
{
    public const CODE = 0;

    public const FIELD_CODE = 'code';

    /**
     * @var string
     */
    public $format = self::FORMAT_JSON;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->data[self::FIELD_CODE] = static::CODE;
    }
}
