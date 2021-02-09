<?php

namespace zabachok\api\dtos;

class ListDto
{
    public int $total;
    public bool $hasNext;
    public array $records;
}
