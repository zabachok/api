<?php

namespace zabachok\api\services;

use zabachok\api\builders\IBuilder;
use yii\base\Model;

interface IBuilderService
{
    /**
     * @param Model $form
     *
     * @return IBuilder
     */
    public function behave(Model $form): IBuilder;
}
