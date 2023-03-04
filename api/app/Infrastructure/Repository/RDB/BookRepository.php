<?php

namespace App\Infrastructure\Repository\RDB;

use App\Domain\Book\BookDto;
use App\Domain\Book\BookEntity;
use App\Domain\Book\BookRepositoryInterface;
use App\Infrastructure\ORM\BookOrm;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BookRepository implements BookRepositoryInterface
{
    /**
     * @param BookEntity $bookEntity
     * @return BookDto
     */
    public function save(BookEntity $bookEntity): BookDto
    {
        /** @var BookOrm $bookOrm */
        $bookOrm = BookOrm::query()->create(
            [
                "title" => $bookEntity->title,
                "description" => $bookEntity->description,
                "cover_image_url" => $bookEntity->coverImageUrl,
                "page" => $bookEntity->page,
                "published_date" => $bookEntity->publishedDate,
                "publisher_id" => $bookEntity->publisherId,
            ]
        );
        $reconstructedBookEntity = BookEntity::reconstructFromRepository(
            $bookOrm->id,
            $bookOrm->title,
            $bookOrm->description,
            $bookOrm->cover_image_url,
            $bookOrm->page,
            $bookOrm->published_date,
            $bookOrm->publisher_id,
        );
        return $reconstructedBookEntity->toDto();
    }

    /**
     * @param string $title
     * @return BookDto
     * @throws ModelNotFoundException
     */
    public function getByTitle(string $title): BookDto
    {
        /** @var BookOrm $bookOrm */
        $bookOrm = BookOrm::query()->where("title", $title)->firstOrFail();
        $reconstructedBookEntity = BookEntity::reconstructFromRepository(
            $bookOrm->id,
            $bookOrm->title,
            $bookOrm->description,
            $bookOrm->cover_image_url,
            $bookOrm->page,
            $bookOrm->published_date,
            $bookOrm->publisher_id,
        );
        return $reconstructedBookEntity->toDto();
    }
}
