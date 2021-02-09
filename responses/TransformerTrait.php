<?php

namespace zabachok\api\responses;

use Yii;

trait TransformerTrait
{
    protected function transformCollection(array $objects, string $className): array
    {
        $transformer = Yii::$container->get($className);
        $result = [];

        foreach ($objects as $object) {
            $result[] = $transformer->transform($object);
        }

        return $result;
    }
}
