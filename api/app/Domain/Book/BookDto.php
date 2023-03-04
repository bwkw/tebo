<?php

namespace App\Domain\Book;

use Carbon\CarbonImmutable;

readonly class BookDto
{
    public int $id;
    public string $title;
    public string $description;
    public string $coverImageUrl;
    public int $page;
    public CarbonImmutable $publishedDate;
    public ?int $publisherId;

    public function __construct(
        int $id,
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
}
