<?php

namespace zabachok\api\components\validators\native;

use yii\validators\RangeValidator as BaseBooleanValidator;

class RangeValidator extends BaseBooleanValidator
{
    public $strict = true;
}
