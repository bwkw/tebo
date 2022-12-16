<?php

namespace App\Usecase\Usecase\Book;

use App\Domain\DomainService\BookDomainService;
use App\Domain\DTO\BookDto;
use App\Domain\Entity\BookEntity;
use App\Domain\RepositoryInterface\BookRepositoryInterface;

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
