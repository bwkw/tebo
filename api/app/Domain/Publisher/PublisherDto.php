<?php

namespace App\Domain\Publisher;

readonly class PublisherDto
{
    public int $id;
    public string $name;

    public function __construct(
        int $id,
        string $name
    ) {
        $this->id = $id;
        $this->name = $name;
    }
}
