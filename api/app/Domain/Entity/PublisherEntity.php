<?php

namespace App\Domain\Entity;

use App\Domain\DTO\PublisherDto;

class PublisherEntity
{
    private readonly int $id;
    private readonly string $name;

    private function __construct(
        int $id,
        string $name,
    )
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function reconstructFromRepository(PublisherDto $publisherDto): self
    {
        return new self(
            $publisherDto->id,
            $publisherDto->name,
        );
    }
}
