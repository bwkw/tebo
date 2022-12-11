<?php

namespace App\Domain\DTO;

use Carbon\CarbonImmutable;

class BookDto
{
    public readonly int $id;
    public readonly string $title;
    public readonly string $description;
    public readonly string $coverImageUrl;
    public readonly int $page;
    public readonly CarbonImmutable $publishedDate;
    public readonly ?int $publisherId;

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
