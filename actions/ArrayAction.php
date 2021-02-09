<?php

namespace zabachok\api\actions;

use zabachok\api\responses\IResponse;
use zabachok\api\responses\universal\ArrayResponse;

/**
 * @property ArrayResponse $response
 */
class ArrayAction extends AbstractAction
{
    public $response = ArrayResponse::class;

    public function process($result): IResponse
    {
        return $this->response->setArray($result);
    }
}
