<?php

namespace zabachok\api\models;

use zabachok\api\exceptions\RepositoryNotFoundException;
use yii\db\ActiveRecord as YiiActiveRecord;

class ActiveRecord extends YiiActiveRecord
{
    public function save($runValidation = false, $attributeNames = null): bool
    {
        $save = parent::save($runValidation);

        if (!$save) {
            throw new RepositoryNotFoundException('Record not saved');
        }

        return $save;
    }

    public static function findOne($condition)
    {
        $result = parent::findOne($condition);

        if (null === $result) {
            throw new RepositoryNotFoundException('Nothing found');
        }

        return $result;
    }

    public function rules(): array
    {
        return [[array_keys($this->getAttributes()), 'safe']];
    }
}
