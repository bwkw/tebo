<?php

namespace App\Domain\Book;

use Illuminate\Database\Eloquent\ModelNotFoundException;

class BookDomainService
{
    private BookRepositoryInterface $bookRepository;

    public function __construct(BookRepositoryInterface $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    /**
     * @param BookEntity $bookEntity
     * @return bool
     */
    public function exists(BookEntity $bookEntity): bool
    {
        try {
            $this->bookRepository->getByTitle($bookEntity->title);
            return true;
        } catch (ModelNotFoundException) {
            return false;
        }
    }
}
