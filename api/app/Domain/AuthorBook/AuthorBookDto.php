<?php

namespace App\Domain\AuthorBook;

readonly class AuthorBookDto
{
    public int $id;
    public ?int $authorId;
    public int $bookId;

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
