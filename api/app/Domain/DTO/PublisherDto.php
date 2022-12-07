<?php

namespace App\Domain\DTO;

class PublisherDto
{
    public readonly int $id;
    public readonly string $name;

    public function __construct(
        int $id,
        string $name
    )
    {
        $this->id = $id;
        $this->name = $name;
    }
}
