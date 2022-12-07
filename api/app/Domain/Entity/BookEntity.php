<?php

namespace App\Domain\Entity;

use App\Domain\DTO\BookDto;
use Carbon\CarbonImmutable;
use LogicException;

class BookEntity
{
    private readonly ?int $id;
    private readonly string $title;
    private readonly string $description;
    private readonly string $imageUrl;
    private readonly int $page;
    private readonly CarbonImmutable $publishedDate;
    private readonly int $authorId;
    private readonly int $publisherId;

    private function __construct(
        ?int $id,
        string $title,
        string $description,
        string $imageUrl,
        int $page,
        CarbonImmutable $publishedDate,
        int $authorId,
        int $publisherId,
    )
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->imageUrl = $imageUrl;
        $this->page = $page;
        $this->publishedDate = $publishedDate;
        $this->authorId = $authorId;
        $this->publisherId = $publisherId;
    }

    public static function constructNewInstance(
        string $title,
        string $description,
        string $imageUrl,
        int $page,
        CarbonImmutable $publishedDate,
        int $authorId,
        int $publisherId,
    ): self {
        // todo: ドメインバリデーション
        return new self(null, $title, $description, $imageUrl, $page, $publishedDate, $authorId, $publisherId);
    }

    public static function reconstructFromRepository(
        int $id,
        string $title,
        string $description,
        string $imageUrl,
        int $page,
        CarbonImmutable $publishedDate,
        int $authorId,
        int $publisherId,
    ): self {
        return new self($id, $title, $description, $imageUrl, $page, $publishedDate, $authorId, $publisherId);
    }

    public function id(): int
    {
        if ($this->id === null) {
            throw new LogicException("Repositoryを通す前にこのメソッドを呼び出さないでください。");
        }

        return $this->id;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function imageUrl(): string
    {
        return $this->imageUrl;
    }

    public function page(): int
    {
        return $this->page;
    }

    public function publishedDate(): CarbonImmutable
    {
        return $this->publishedDate;
    }

    public function authorId(): int
    {
        return $this->authorId;
    }

    public function publisherId(): int
    {
        return $this->publisherId;
    }

    public function toDto(): BookDto
    {
        return new BookDto(
            $this->id,
            $this->title,
            $this->description,
            $this->imageUrl,
            $this->page,
            $this->publishedDate,
            $this->authorId,
            $this->publisherId,
        );
    }
}
