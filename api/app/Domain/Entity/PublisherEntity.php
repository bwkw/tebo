<?php

namespace App\Domain\Entity;

use App\Domain\DTO\PublisherDto;

class PublisherEntity
{
    private readonly ?int $id;
    private readonly string $name;

    private function __construct(
        int $id,
        string $name,
    )
    {
        $this->id = $id;
        $this->name = $name;
    }

    public static function constructNewInstance($name): self
    {
        // todo: ドメインバリデーション
        return new self(
            null,
            $name,
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
