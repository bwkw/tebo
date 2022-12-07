<?php

namespace App\Domain\DTO;

use Carbon\CarbonImmutable;

class BookDto
{
    public readonly int $id;
    public readonly string $title;
    public readonly string $description;
    public readonly string $imageUrl;
    public readonly int $page;
    public readonly CarbonImmutable $publishedDate;
    public readonly int $authorId;
    public readonly int $publisherId;

    public function __construct(
        int $id,
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
}
