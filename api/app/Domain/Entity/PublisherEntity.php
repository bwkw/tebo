<?php

namespace App\Domain\Entity;

use App\Domain\DTO\PublisherDto;
use LogicException;

class PublisherEntity
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

    public function name(): string
    {
        return $this->name;
    }

    public function toDto(): PublisherDto
    {
        return new PublisherDto(
            $this->id,
            $this->name,
        );
    }
}
