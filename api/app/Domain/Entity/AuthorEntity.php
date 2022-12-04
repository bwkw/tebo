<?php

namespace App\Domain\Entity;

use App\Domain\DTO\AuthorDto;

class AuthorEntity
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

    public function reconstructFromRepository(AuthorDto $authorDto): self
    {
        return new self(
            $authorDto->id,
            $authorDto->name,
        );
    }
}
