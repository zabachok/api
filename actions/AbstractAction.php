<?php

namespace zabachok\api\actions;

use zabachok\api\exceptions\ServiceNotFoundException;
use zabachok\api\responses\ApiResponse;
use zabachok\api\responses\IResponse;
use zabachok\api\responses\NotValidResponse;
use zabachok\api\responses\SuccessResponse;
use zabachok\api\services\IBuilderService;
use Yii;
use yii\base\Action;
use yii\base\Model;
use yii\web\NotFoundHttpException;
use yii\web\Response;

abstract class AbstractAction extends Action
{
    /**
     * @var Model
     */
    public $form;

    /**
     * @var IBuilderService
     */
    public $service;

    public string $method = 'GET';

    /**
     * @var ApiResponse
     */
    public $response = SuccessResponse::class;

    public function init(): void
    {
        parent::init();
        foreach ($this->getClassesFields() as $field) {
            $this->$field = is_array($this->$field) ? Yii::createObject($this->$field) : Yii::$container->get($this->$field);
        }
    }

    protected function getClassesFields(): array
    {
        return ['form', 'service', 'response'];
    }

    public function run()
    {
        $this->checkMethod();
        $data = Yii::$app->request->isGet ? Yii::$app->request->get() : Yii::$app->request->post();
        $this->form->setAttributes($data);

        if (!$this->form->validate()) {
            Yii::info($this->form->getFirstErrors());
            $response = Yii::$container->get(NotValidResponse::class)->setFields($this->form->getFirstErrors());
        } else {
            try {
                $response = $this->process($this->service->behave($this->form));
            } catch (ServiceNotFoundException $exception) {
                throw new NotFoundHttpException($exception->getMessage());
            }
        }

        /** @var Response $baseResponse */
        $baseResponse = Yii::$app->response;
        $baseResponse->format = Response::FORMAT_JSON;
        $baseResponse->data = $response->getContent();
        $baseResponse->setStatusCode($response->getHttpCode());

        return $baseResponse;
    }

    abstract protected function process($result): IResponse;

    private function checkMethod(): void
    {
        if ($this->method !== Yii::$app->request->method) {
            throw new NotFoundHttpException('Endpoint is not found');
        }
    }
}
