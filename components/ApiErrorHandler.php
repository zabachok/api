<?php

namespace zabachok\api\components;

use Yii;
use yii\web\ErrorHandler;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class ApiErrorHandler extends ErrorHandler
{
    /**
     * @inheridoc
     */
    protected function renderException($exception)
    {
        if (Yii::$app->has('response')) {
            $response = Yii::$app->getResponse();
        } else {
            $response = new Response();
        }
        $response->format = Response::FORMAT_JSON;

//        $response->data = $this->convertExceptionToArray($exception);
        if ($exception instanceof ForbiddenHttpException) {
            $response->data = [
                'code' => 4,
                'message' => $exception->getMessage(),
            ];
        } elseif ($exception instanceof NotFoundHttpException) {
            $response->data = [
                'code' => 5,
                'message' => $exception->getMessage(),
            ];
        } else {
            $response->data = [
                'code' => 1,
                'message' => $exception->getMessage(),
            ];
        }

        $response->setStatusCode($exception->statusCode ?? 500);

//        (new DefenderOfRepeatedAnswer())->afterError($response);

        $response->send();
    }
}
