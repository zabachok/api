<?php

namespace zabachok\api\actions;

use zabachok\api\responses\IResponse;
use zabachok\api\responses\ObjectResponse;

class ObjectAction extends AbstractAction
{
    /**
     * @var ObjectResponse
     */
    public $response = ObjectResponse::class;

    protected function process($result): IResponse
    {
        return $this->response->setObject($result);
    }
}
