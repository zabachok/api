<?php

namespace zabachok\api\components\validators;

use yii\base\Model;
use yii\validators\Validator;

class ExplodeFilter extends Validator
{
    /**
     * @var string
     */
    public $callback = 'intval';

    /**
     * @param Model $model
     * @param string $attribute
     *
     * @return array
     */
    public function validateAttribute($model, $attribute)
    {
        $list = explode(',', $model->$attribute);
        array_walk($list, function (&$item) {
            $item = ($this->callback)($item);
        });

        $model->$attribute = $list;
    }
}
