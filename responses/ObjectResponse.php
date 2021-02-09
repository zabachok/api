<?php

namespace zabachok\api\responses;

abstract class ObjectResponse extends SuccessResponse
{
    /**
     * @var object
     */
    protected $object;

    public function getData(): array
    {
        return $this->transformObjectToArray($this->object);
    }

    /**
     * @param object $object
     *
     * @return array
     */
    abstract protected function transformObjectToArray($object): array;

    /**
     * @param object $object
     *
     * @return ObjectResponse
     */
    public function setObject($object): ObjectResponse
    {
        $this->object = $object;

        return $this;
    }
}
