<?php

namespace zabachok\api\actions;

use zabachok\api\exceptions\ServiceNotFoundException;
use zabachok\api\responses\IResponse;
use zabachok\api\responses\universal\EnumResponse;
use Yii;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class EnumAction extends AbstractAction
{
    public $enumClass;

    /**
     * @var string|EnumResponse
     */
    public $response = EnumResponse::class;

    public function run()
    {

        try {
            $response = $this->process(null);
        } catch (ServiceNotFoundException $exception) {
            throw new NotFoundHttpException($exception->getMessage());
        }


        /** @var Response $baseResponse */
        $baseResponse = Yii::$app->response;
        $baseResponse->format = Response::FORMAT_JSON;
        $baseResponse->data = $response->getContent();
        $baseResponse->setStatusCode($response->getHttpCode());

        return $baseResponse;
    }

    protected function process($result): IResponse
    {
        return $this->response->setEnumClass($this->enumClass);
    }

    protected function getClassesFields(): array
    {
        return ['response'];
    }
}
