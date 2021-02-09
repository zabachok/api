<?php

namespace zabachok\api\services;

use yii\base\Model;

interface ISuccessService
{
    /**
     * @param Model $form
     *
     * @return bool
     */
    public function behave(Model $form): bool;
}
