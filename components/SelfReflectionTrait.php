<?php

namespace zabachok\api\components;

use ReflectionClass;

trait SelfReflectionTrait
{
    private ReflectionClass $selfReflection;

    protected function getSelfId(): string
    {
        return $this->getSelfReflection()->getShortName();
    }

    protected function getSelfReflection(): ReflectionClass
    {
        if (!isset($this->selfReflection)) {
            $this->selfReflection = new ReflectionClass($this);
        }
        return $this->selfReflection;
    }
}
