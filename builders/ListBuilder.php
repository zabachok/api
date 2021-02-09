<?php

namespace zabachok\api\builders;

use zabachok\api\dtos\ListDto;

class ListBuilder implements IBuilder
{
    private bool $hasNext;
    private array $records;
    private int $total;

    public function build(): ListDto
    {
        $dto = new ListDto();

        $dto->total = $this->total;
        $dto->hasNext = $this->hasNext;
        $dto->records = $this->records;

        return $dto;
    }

    public function setTotal(int $total): ListBuilder
    {
        $this->total = $total;

        return $this;
    }

    public function setHasNext(bool $hasNext): ListBuilder
    {
        $this->hasNext = $hasNext;

        return $this;
    }

    public function setRecords(array $records): ListBuilder
    {
        $this->records = [];

        foreach ($records as $record) {
            $this->addRecord($record);
        }

        return $this;
    }

    private function addRecord($record): ListBuilder
    {
        $this->records[] = $record;

        return $this;
    }
}
