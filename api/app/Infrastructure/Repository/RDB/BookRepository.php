<?php

namespace App\Infrastructure\Repository\RDB;

use App\Domain\DTO\BookDto;
use App\Domain\RepositoryInterface\BookRepositoryInterface;
use App\Infrastructure\ORM\BookOrm;

class BookRepository implements BookRepositoryInterface
{
    private BookOrm $bookOrm;

    private function __construct(BookOrm $bookOrm)
    {
        $this->bookOrm = $bookOrm;
    }

    public function save(BookDto $bookDto): void
    {
        $this->bookOrm->query()->create(
            [
                "title" => $bookDto->title,
                "image_url" => $bookDto->imageUrl,
                "page" => $bookDto->page,
                "published_date" => $bookDto->publishedDate,
                "author_id" => $bookDto->authorId,
                "publish_id" =>$bookDto->publisherId,
            ]
        );
    }
}
