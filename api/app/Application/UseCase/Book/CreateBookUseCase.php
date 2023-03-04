<?php

namespace App\UseCase\UseCase\Book;

use App\Domain\Book\BookDomainService;
use App\Domain\Book\BookDto;
use App\Domain\Book\BookEntity;
use App\Domain\Book\BookRepositoryInterface;

class CreateBookUseCase
{
    private BookDomainService $bookDomainService;
    private BookRepositoryInterface $bookRepository;

    public function __construct(
        BookDomainService $bookDomainService,
        BookRepositoryInterface $bookRepository,
    ) {
        $this->bookDomainService = $bookDomainService;
        $this->bookRepository = $bookRepository;
    }

    /**
     * @param BookEntity $bookEntity
     * @return BookDto
     */
    public function execute(BookEntity $bookEntity): BookDto
    {
        if ($this->bookDomainService->exists($bookEntity)) {
            return $this->bookRepository->getByTitle($bookEntity->title);
        }
        return $this->bookRepository->save($bookEntity);
    }
}
