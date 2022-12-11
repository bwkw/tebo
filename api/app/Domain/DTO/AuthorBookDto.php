<?php

namespace App\Domain\DTO;

class AuthorBookDto
{
    public readonly int $id;
    public readonly ?int $authorId;
    public readonly int $bookId;

    public function __construct(
        int $id,
        ?int $authorId,
        int $bookId,
    ) {
        $this->id = $id;
        $this->authorId = $authorId;
        $this->bookId = $bookId;
    }
}
