<?php

namespace zabachok\api\responses;

class NotValidResponse implements IResponse
{
    /**
     * @var array
     */
    protected $fields = [];

    /**
     * @param string $field
     * @param string $value
     *
     * @return NotValidResponse
     */
    public function addField(string $field, string $value): NotValidResponse
    {
        $this->fields[$field] = $value;

        return $this;
    }

    /**
     * @param array $fields
     *
     * @return NotValidResponse
     */
    public function setFields(array $fields): NotValidResponse
    {
        $this->fields = $fields;

        return $this;
    }

    public function getContent(): array
    {
        return [
            'code' => $this->getApplicationCode(),
            'fields' => $this->fields,
        ];
    }

    public function getApplicationCode(): int
    {
        return 2;
    }

    public function getHttpCode(): int
    {
        return 200;
    }
}
