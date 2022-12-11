<?php

namespace App\Domain\DomainService;

use App\Domain\Entity\BookEntity;
use App\Domain\RepositoryInterface\BookRepositoryInterface;
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
    public function Exists(BookEntity $bookEntity): bool
    {
        try {
            $this->bookRepository->getByTitle($bookEntity->title);
            return true;
        } catch (ModelNotFoundException) {
            return false;
        }
    }
}
