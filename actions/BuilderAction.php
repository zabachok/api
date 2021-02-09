<?php

namespace zabachok\api\actions;

use zabachok\api\responses\BuilderResponse;
use zabachok\api\responses\IResponse;

class BuilderAction extends AbstractAction
{
    /**
     * @var BuilderResponse
     */
    public $response = BuilderResponse::class;

    protected function process($result): IResponse
    {
        return $this->response->setBuilder($result);
    }
}
