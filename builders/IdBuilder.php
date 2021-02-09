<?php

namespace zabachok\api\builders;

class IdBuilder implements IBuilder
{
    private int $id;

    public function build(): int
    {
        return $this->id;
    }

    public function setId(int $id): IdBuilder
    {
        $this->id = $id;

        return $this;
    }
}
