<?php

namespace zabachok\api\components\validators\native;

use yii\validators\NumberValidator as BaseNumberValidator;

class NumberValidator extends BaseNumberValidator
{
    /**
     * @inheritdoc
     */
    public function validateAttribute($model, $attribute)
    {
        parent::validateAttribute($model, $attribute);
        if (!$model->hasErrors($attribute) && !is_null($model->$attribute)) {
            $model->$attribute = $this->integerOnly ? (int)$model->$attribute : (float)$model->$attribute;
        }
    }
}
