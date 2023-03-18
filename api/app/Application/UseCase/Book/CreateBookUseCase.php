<?php

namespace App\Application\UseCase\Book;

use App\Domain\Book\BookDomainService;
use App\Domain\Book\BookDto;
use App\Domain\Book\BookEntity;
use App\Domain\Book\BookRepositoryInterface;
use Carbon\CarbonImmutable;

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
     * @param string $title
     * @param string $description
     * @param string $coverImageUrl
     * @param int $page
     * @param CarbonImmutable $publishedDate
     * @param int|null $publisherId
     *
     * @return BookDto
     */
    public function execute(
        string $title,
        string $description,
        string $coverImageUrl,
        int $page,
        CarbonImmutable $publishedDate,
        ?int $publisherId
    ): BookDto {
        $bookEntity = BookEntity::constructNewInstance(
            $title,
            $description,
            $coverImageUrl,
            $page,
            $publishedDate,
            $publisherId,
        );

        if ($this->bookDomainService->exists($bookEntity)) {
            return $this->bookRepository->getByTitle($bookEntity->title);
        }
        return $this->bookRepository->save($bookEntity);
    }
}
