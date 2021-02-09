<?php

namespace zabachok\api\actions;

use zabachok\api\responses\IResponse;

class CallbackAction extends AbstractAction
{
    /**
     * @var callable
     */
    public $callback;
    public $response = ArrayResponse::class;

    protected function process($result): IResponse
    {
        return $this->response->setArray(
            $this->callback()
        );
    }
}
