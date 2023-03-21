<?php

namespace App\Application\DTO;

use Carbon\CarbonImmutable;

readonly class BibliographyDto
{
    public int $id;
    public string $title;
    public string $description;
    public string $coverImageUrl;
    public int $page;
    public CarbonImmutable $publishedDate;
    public ?string $publisher;
    public ?array $authors;

    public function __construct(
        int $id,
        string $title,
        string $description,
        string $coverImageUrl,
        int $page,
        CarbonImmutable $publishedDate,
        ?string $publisher,
        ?array $authors,
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->coverImageUrl = $coverImageUrl;
        $this->page = $page;
        $this->publishedDate = $publishedDate;
        $this->publisher = $publisher;
        $this->authors = $authors;
    }
}
