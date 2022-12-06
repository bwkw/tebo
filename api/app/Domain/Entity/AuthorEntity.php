<?php

namespace App\Domain\Entity;

use App\Domain\DTO\AuthorDto;
use LogicException;

class AuthorEntity
{
    private readonly ?int $id;
    private readonly string $name;

    private function __construct(
        ?int $id,
        string $name,
    )
    {
        $this->id = $id;
        $this->name = $name;
    }

    public static function constructNewInstance($name): self
    {
        // Todo: ドメインバリデーション
        return new self(
            null,
            $name,
        );
    }

    public function reconstructFromRepository(AuthorDto $authorDto): self
    {
        return new self(
            $authorDto->id,
            $authorDto->name,
        );
    }

    public function id(): int
    {
        if ($this->id === null) {
            throw new LogicException("RDBに保存する前にこのメソッドを呼び出さないでください。");
        }

        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }
}
