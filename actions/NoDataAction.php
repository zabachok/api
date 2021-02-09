<?php

namespace zabachok\api\actions;

use zabachok\api\responses\IResponse;
use zabachok\api\responses\universal\NoDataResponse;

class NoDataAction extends AbstractAction
{
    public $response = NoDataResponse::class;

    protected function process($result): IResponse
    {
        return $this->response;
    }
}
