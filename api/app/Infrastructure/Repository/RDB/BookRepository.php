<?php

namespace App\Infrastructure\Repository\RDB;

use App\Domain\DTO\BookDto;
use App\Domain\Entity\BookEntity;
use App\Domain\RepositoryInterface\BookRepositoryInterface;
use App\Infrastructure\ORM\BookOrm;

class BookRepository implements BookRepositoryInterface
{
    public function save(BookEntity $bookEntity): BookDto
    {
        /** @var BookOrm $bookOrm */
        $bookOrm = BookOrm::query()->create(
            [
                "title" => $bookEntity->title(),
                "description" => $bookEntity->description(),
                "image_url" => $bookEntity->imageUrl(),
                "page" => $bookEntity->page(),
                "published_date" => $bookEntity->publishedDate(),
                "author_id" => $bookEntity->authorId(),
                "publish_id" =>$bookEntity->publisherId(),
            ]
        );
        $reconstructedBookEntity = BookEntity::reconstructFromRepository(
            $bookOrm->id,
            $bookOrm->title,
            $bookOrm->description,
            $bookOrm->imageUrl,
            $bookOrm->page,
            $bookOrm->publishedDate,
            $bookOrm->authorId,
            $bookOrm->publisherId,
        );
        return $reconstructedBookEntity->toDto();
    }
}
