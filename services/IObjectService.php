<?php

namespace zabachok\api\services;

use yii\base\Model;

interface IObjectService
{
    /**
     * @param Model $form
     *
     * @return object
     */
    public function behave(Model $form);
}
