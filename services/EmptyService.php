<?php

namespace zabachok\api\services;

use yii\base\Model;

class EmptyService implements IArrayService
{
    /**
     * @param Model $form
     *
     * @return array
     */
    public function behave(Model $form): array
    {
        return [
            'form' => $form,
        ];
    }
}
