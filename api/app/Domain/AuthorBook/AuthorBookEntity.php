<?php

namespace App\Domain\AuthorBook;

use LogicException;

class AuthorBookEntity
{
    private readonly ?int $id;
    public readonly ?int $authorId;
    public readonly int $bookId;

    private function __construct(
        ?int $id,
        ?int $authorId,
        int $bookId,
    ) {
        $this->id = $id;
        $this->authorId = $authorId;
        $this->bookId = $bookId;
    }

    public static function constructNewInstance(?int $authorId, int $bookId): self
    {
        // todo: ドメインバリデーション
        return new self(
            null,
            $authorId,
            $bookId,
        );
    }

    public static function reconstructFromRepository($id, ?int $authorId, int $bookId): self
    {
        return new self(
            $id,
            $authorId,
            $bookId,
        );
    }

    public function id(): int
    {
        if ($this->id === null) {
            throw new LogicException("Repositoryを通す前にこのメソッドを呼び出さないでください。");
        }

        return $this->id;
    }

    public function toDto(): AuthorBookDto
    {
        return new AuthorBookDto(
            $this->id,
            $this->authorId,
            $this->bookId,
        );
    }
}
