<?php

namespace zabachok\api\components;

use Yii;

/**
 * @property integer userId
 */
trait UserId
{
    /**
     * @return int
     */
    public function getUserId(): int
    {
        return Yii::$app->user->id;
    }

    /**
     * @inheritdoc
     */
    public function fields()
    {
        return array_merge(parent::fields(), ['userId']);
    }
}
