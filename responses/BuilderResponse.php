<?php

namespace zabachok\api\responses;

use zabachok\api\builders\IBuilder;

abstract class BuilderResponse extends SuccessResponse
{
    /**
     * @var IBuilder
     */
    protected $builder;

    /**
     * @param IBuilder $builder
     *
     * @return BuilderResponse
     */
    public function setBuilder(IBuilder $builder): BuilderResponse
    {
        $this->builder = $builder;

        return $this;
    }

    public function getData(): array
    {
        return $this->transformObjectToArray($this->builder);
    }

    /**
     * @param IBuilder $builder
     *
     * @return array
     */
    abstract protected function transformObjectToArray(IBuilder $builder): array;
}
