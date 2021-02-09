<?php

namespace zabachok\api\tests;

use zabachok\api\doc\other\response\ResponseSaver;
use zabachok\api\tests\testers\GridTester;
use zabachok\api\tests\testers\PageTester;
use zabachok\api\tests\testers\ProjectTester;
use zabachok\api\tests\testers\SiteTester;
use zabachok\api\tests\testers\TaskTester;
use zabachok\api\tests\testers\UniversalTester;
use zabachok\api\tests\testers\UserTester;
use Codeception\Actor;
use Codeception\Lib\Friend;
use Codeception\Util\HttpCode;
use Exception;
use Yii;

/**
 * Inherited Methods
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method Friend haveFriend($name, $actorClass = null)
 * @SuppressWarnings(PHPMD)
 */
class FunctionalTester extends Actor
{
    use _generated\FunctionalTesterActions;
    use SiteTester, UniversalTester, PageTester, GridTester;

    /**
     * @param array $fields
     *
     * @throws Exception
     */
    public function checkNotValid(array $fields): void
    {
        $this->seeResponseContainsJson(['code' => 2]);

        $type = array_fill_keys($fields, 'string');
        $this->checkStructure($type, '$.fields');
    }

    /**
     * @param array $structure
     * @param string $path
     *
     * @throws Exception
     */
    public function checkStructure(array $structure, string $path): void
    {
        $count = count($structure);

        $this->seeResponseMatchesJsonType($structure, $path);
        $items = $this->grabDataFromResponseByJsonPath($path);
        foreach ($items as $item) {
            $this->assertCount($count, $item);
        }
    }

    /**
     * @return void
     */
    public function checkSuccess(): void
    {
        $this->dontSeeResponseJsonMatchesJsonPath('$.fields');
        $this->seeResponseContainsJson(['code' => 0]);
    }

    public function checkNotFound(): void
    {
        $this->seeResponseCodeIs(HttpCode::NOT_FOUND);
        $this->seeResponseContainsJson(['code' => 5]);
    }

    public function checkAccessDenied(): void
    {
//        $this->seeResponseCodeIs(HttpCode::FORBIDDEN);
        $this->seeResponseContainsJson(['code' => 4]);
    }

    /**
     * @param array $fields
     *
     * @throws Exception
     */
    public function checkBadRequest(array $fields = []): void
    {
        $this->seeResponseContainsJson(['code' => 2]);

        if ($fields) {
            $message = 'Not valid: ' . implode(', ', $fields);
            $this->checkValue($message, '$.message');
        }
    }

    /**
     * @param mixed $expected
     * @param string $path
     *
     * @throws Exception
     */
    public function checkValue($expected, string $path): void
    {
        $data = $this->grabDataFromResponseByJsonPath($path);
        $this->assertEquals($expected, $data[0]);
    }

    /**
     * @return void
     */
    public function checkUnauthorized(): void
    {
        $this->seeResponseContainsJson(['code' => 4]);
    }

    /**
     * @param array $expected
     * @param string $path
     *
     * @throws Exception
     */
    public function checkArray(array $expected, string $path): void
    {
        $data = $this->grabDataFromResponseByJsonPath($path);
        $this->assertEquals($expected, $data);
    }

    /**
     * @param string $path
     *
     * @return mixed
     */
    public function grabValueByPath(string $path)
    {
        return $this->grabDataFromResponseByJsonPath($path)[0];
    }

    public function sendGETSuccess($url, $params = [])
    {
        $this->sendGET($url, $params);
        if (!$this->isSuccess()) {
            return;
        }

        $saver = Yii::$container->get(ResponseSaver::class);
        $saver->saveResponse($url, $params, $this->grabValueByPath('$.data'));
    }

    public function sendPOSTSuccess($url, $params = [], $files = [])
    {
        $this->sendPOST($url, $params, $files);
        if (!$this->isSuccess()) {
            return;
        }

        $saver = Yii::$container->get(ResponseSaver::class);
        $saver->saveResponse($url, $params, $this->grabValueByPath('$.data'));
    }

    private function isSuccess(): bool
    {
        return $this->grabValueByPath('$.code') === 0;
    }
}
