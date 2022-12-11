<?php

namespace App\Infrastructure\Repository\RDB;

use App\Domain\DTO\BookDto;
use App\Domain\Entity\BookEntity;
use App\Domain\RepositoryInterface\BookRepositoryInterface;
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
                "title" => $bookEntity->title(),
                "description" => $bookEntity->description(),
                "image_url" => $bookEntity->imageUrl(),
                "page" => $bookEntity->page(),
                "published_date" => $bookEntity->publishedDate(),
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
            $bookOrm->publisherId,
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
            $bookOrm->imageUrl,
            $bookOrm->page,
            $bookOrm->publishedDate,
            $bookOrm->publisherId,
        );
        return $reconstructedBookEntity->toDto();
    }
}
