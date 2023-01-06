<?php

namespace App\Domain\Entity;

use App\Domain\DTO\BookDto;
use Carbon\CarbonImmutable;
use LogicException;

class BookEntity
{
    private readonly ?int $id;
    public readonly string $title;
    public readonly string $description;
    public readonly string $coverImageUrl;
    public readonly int $page;
    public readonly CarbonImmutable $publishedDate;
    public readonly ?int $publisherId;

    private function __construct(
        ?int $id,
        string $title,
        string $description,
        string $coverImageUrl,
        int $page,
        CarbonImmutable $publishedDate,
        ?int $publisherId,
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->coverImageUrl = $coverImageUrl;
        $this->page = $page;
        $this->publishedDate = $publishedDate;
        $this->publisherId = $publisherId;
    }

    public static function constructNewInstance(
        string $title,
        string $description,
        string $coverImageUrl,
        int $page,
        CarbonImmutable $publishedDate,
        ?int $publisherId,
    ): self {
        // todo: ドメインバリデーション
        return new self(null, $title, $description, $coverImageUrl, $page, $publishedDate, $publisherId);
    }

    public static function reconstructFromRepository(
        int $id,
        string $title,
        string $description,
        string $coverImageUrl,
        int $page,
        CarbonImmutable $publishedDate,
        ?int $publisherId,
    ): self {
        return new self($id, $title, $description, $coverImageUrl, $page, $publishedDate, $publisherId);
    }

    public function id(): int
    {
        if ($this->id === null) {
            throw new LogicException('Repositoryを通す前にこのメソッドを呼び出さないでください。');
        }

        return $this->id;
    }

    public function toDto(): BookDto
    {
        return new BookDto(
            $this->id,
            $this->title,
            $this->description,
            $this->coverImageUrl,
            $this->page,
            $this->publishedDate,
            $this->publisherId,
        );
    }
}
