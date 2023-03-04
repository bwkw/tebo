<?php

namespace App\Domain\Author;

use LogicException;

readonly class AuthorEntity
{
    private ?int $id;
    public string $name;

    private function __construct(
        ?int $id,
        string $name,
    ) {
        $this->id = $id;
        $this->name = $name;
    }

    public static function constructNewInstance(string $name): self
    {
        // todo: ドメインバリデーション
        return new self(
            null,
            $name,
        );
    }

    public static function reconstructFromRepository(int $id, string $name): self
    {
        return new self(
            $id,
            $name,
        );
    }

    public function id(): int
    {
        if ($this->id === null) {
            throw new LogicException("Repositoryを通す前にこのメソッドを呼び出さないでください。");
        }

        return $this->id;
    }

    public function toDto(): AuthorDto
    {
        return new AuthorDto(
            $this->id,
            $this->name,
        );
    }
}
