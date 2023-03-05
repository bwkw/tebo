<?php

namespace App\Domain\AuthorBook;

use Illuminate\Database\Eloquent\ModelNotFoundException;

class AuthorBookDomainService
{
    private AuthorBookRepositoryInterface $authorBookRepository;

    public function __construct(AuthorBookRepositoryInterface $authorBookRepository)
    {
        $this->authorBookRepository = $authorBookRepository;
    }

    /**
     * @param AuthorBookEntity $authorBookEntity
     * @return bool
     */
    public function exists(AuthorBookEntity $authorBookEntity): bool
    {
        try {
            $this->authorBookRepository->getByAuthorIdBookId(
                $authorBookEntity->authorId,
                $authorBookEntity->bookId
            );
            return true;
        } catch (ModelNotFoundException) {
            return false;
        }
    }
}
