<?php

namespace App\Resources;

use JsonSerializable;

abstract class Resource implements JsonSerializable
{
    public function __construct(
        protected $data
    ) {
        //
    }

    public function toArray(): array
    {
        return (array) $this->data;
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }

    public function __get($name)
    {
        return $this->data->$name;
    }
}
