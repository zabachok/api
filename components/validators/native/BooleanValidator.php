<?php

namespace zabachok\api\components\validators\native;

use yii\validators\BooleanValidator as BaseBooleanValidator;

class BooleanValidator extends BaseBooleanValidator
{
    /**
     * @inheritdoc
     */
    public function validateAttribute($model, $attribute)
    {
        parent::validateAttribute($model, $attribute);
        if (!$model->hasErrors($attribute) && !is_null($model->$attribute)) {
            $model->$attribute = (bool)$model->$attribute;
        }
    }
}
