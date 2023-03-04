<?php

namespace App\Domain\Author;

readonly class AuthorDto
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
