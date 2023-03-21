<?php

namespace App\Application\UseCase\AuthorBook;

use App\Domain\AuthorBook\AuthorBookDomainService;
use App\Domain\AuthorBook\AuthorBookDto;
use App\Domain\AuthorBook\AuthorBookEntity;
use App\Domain\AuthorBook\AuthorBookRepositoryInterface;

class CreateAuthorBookUseCase
{
    private AuthorBookRepositoryInterface $authorBookRepository;
    private AuthorBookDomainService $authorBookDomainService;

    public function __construct(
        AuthorBookRepositoryInterface $authorBookRepository,
        AuthorBookDomainService $authorBookDomainService,
    ) {
        $this->authorBookRepository = $authorBookRepository;
        $this->authorBookDomainService = $authorBookDomainService;
    }

    /**
     * @param int|null $authorId
     * @param int $bookId
     *
     * @return AuthorBookDto
     */
    public function execute(?int $authorId, int $bookId): AuthorBookDto
    {
        $authorBookEntity = AuthorBookEntity::constructNewInstance(
            $authorId,
            $bookId,
        );

        if ($this->authorBookDomainService->exists($authorBookEntity)) {
            return $this->authorBookRepository->fetchByAuthorIdBookId(
                $authorBookEntity->authorId,
                $authorBookEntity->bookId,
            );
        }
        return $this->authorBookRepository->save($authorBookEntity);
    }
}
