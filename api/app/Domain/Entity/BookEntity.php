<?php

namespace App\Domain\Entity;

use App\Domain\DTO\BookDto;
use Carbon\CarbonImmutable;

class BookEntity
{
    private readonly int $id;
    private readonly string $title;
    private readonly string $imageUrl;
    private readonly int $page;
    private readonly CarbonImmutable $publishedDate;
    private readonly int $authorId;
    private readonly int $publisherId;

    private function __construct(
        int $id,
        string $title,
        string $imageUrl,
        int $page,
        CarbonImmutable $publishedDate,
        int $authorId,
        int $publisherId,
    )
    {
        $this->id = $id;
        $this->title = $title;
        $this->imageUrl = $imageUrl;
        $this->page = $page;
        $this->publishedDate = $publishedDate;
        $this->authorId = $authorId;
        $this->publisherId = $publisherId;
    }

    public function reconstructFromRepository(BookDto $bookDto): self
    {
        return new self(
            $bookDto->id,
            $bookDto->title,
            $bookDto->imageUrl,
            $bookDto->page,
            $bookDto->publishedDate,
            $bookDto->authorId,
            $bookDto->publisherId
        );
    }
}
