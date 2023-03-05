<?php

namespace App\Infrastructure\Repository\RDB;

use App\Domain\AuthorBook\AuthorBookDto;
use App\Domain\AuthorBook\AuthorBookEntity;
use App\Domain\AuthorBook\AuthorBookRepositoryInterface;
use App\Infrastructure\ORM\AuthorBookOrm;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AuthorBookRepository implements AuthorBookRepositoryInterface
{
    /**
     * @param AuthorBookEntity $authorBookEntity
     * @return AuthorBookDto
     */
    public function save(AuthorBookEntity $authorBookEntity): AuthorBookDto
    {
        /** @var AuthorBookOrm $authorBookOrm */
        $authorBookOrm = AuthorBookOrm::query()->create(
            [
                "author_id" => $authorBookEntity->authorId,
                "book_id" => $authorBookEntity->bookId,
            ]
        );
        $reconstructedAuthorBookEntity = AuthorBookEntity::reconstructFromRepository(
            $authorBookOrm->id,
            $authorBookOrm->author_id,
            $authorBookOrm->book_id,
        );
        return $reconstructedAuthorBookEntity->toDto();
    }

    /**
     * @param int|null $authorId
     * @param int $bookId
     * @return AuthorBookDto
     * @throws ModelNotFoundException
     */
    public function getByAuthorIdBookId(?int $authorId, int $bookId): AuthorBookDto
    {
        /** @var AuthorBookOrm $authorBookOrm */
        $authorBookOrm = AuthorBookOrm::query()->where([
            ["author_id", "=", $authorId],
            ["book_id", "=", $bookId],
        ])->firstOrFail();
        $reconstructedAuthorBookEntity = AuthorBookEntity::reconstructFromRepository(
            $authorBookOrm->id,
            $authorBookOrm->author_id,
            $authorBookOrm->book_id,
        );
        return $reconstructedAuthorBookEntity->toDto();
    }
}
