<?php

namespace zabachok\api\components\validators;

use Yii;
use yii\base\Model;
use yii\validators\Validator;

class StringToIntArrayFilter extends Validator
{
    /**
     * @param Model $model
     * @param string $attribute
     */
    public function validateAttribute($model, $attribute)
    {
        if(empty($model->$attribute)){
            return;
        }

        if (!\is_string($model->$attribute) || !preg_match('|[\d\,]+|', $model->$attribute)) {
            $this->addError($model, $attribute, Yii::t('app', 'Wrong value format'));
        }

        $model->$attribute = explode(',', $model->$attribute);
        $model->$attribute = array_map('\intval', $model->$attribute);
    }
}
