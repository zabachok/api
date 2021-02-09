<?php

namespace zabachok\api\forms;

use zabachok\api\components\UserId;
use yii\base\Model;

class IdForm extends Model
{
    use UserId;

    public ?int $id = null;

    public function rules(): array
    {
        return [
            ['id', 'required'],
            ['id', 'integer', 'min' => 1],
        ];
    }
}
