<?php

namespace zabachok\api\components\validators;

use yii\base\Model;
use yii\validators\Validator;
use yii2mod\enum\helpers\BaseEnum;

class SortValidator extends Validator
{
    /**
     * @var BaseEnum
     */
    public $enum;

    /**
     * @param Model $model
     * @param string $attribute
     */
    public function validateAttribute($model, $attribute)
    {
        if ($model->hasErrors()) {
            return;
        }
        $value = $model->$attribute;
        $sorts = $this->getFormatSort($value);

        foreach ($sorts as $sort => $direction) {
            if (!$this->enum::isValidValue($sort)) {
                $model->addError($attribute, 'Sort not valid');

                return;
            }
        }

        $model->$attribute = $sorts;
    }

    /**
     * @param string $sortFromModel
     *
     * @return array
     */
    private function getFormatSort(string $sortFromModel): array
    {
        $formatSort = [];
        $sorts = explode(',', $sortFromModel);
        foreach ($sorts as $sort) {
            $direction = SORT_ASC;
            if ($sort[0] === '-') {
                $direction = SORT_DESC;
                $sort = substr($sort, 1);
            }

            $formatSort[$sort] = $direction;
        }

        return $formatSort;
    }
}
