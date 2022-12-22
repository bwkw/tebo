<?php

namespace App\UseCase\UseCase\AuthorBook;

use App\Domain\DomainService\AuthorBookDomainService;
use App\Domain\DTO\AuthorBookDto;
use App\Domain\Entity\AuthorBookEntity;
use App\Domain\RepositoryInterface\AuthorBookRepositoryInterface;

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
     * @param AuthorBookEntity $authorBookEntity
     * @return AuthorBookDto
     */
    public function execute(AuthorBookEntity $authorBookEntity): AuthorBookDto
    {
        if ($this->authorBookDomainService->exists($authorBookEntity)) {
            return $this->authorBookRepository->getByAuthorIdBookId(
                $authorBookEntity->authorId,
                $authorBookEntity->bookId,
            );
        }
        return $this->authorBookRepository->save($authorBookEntity);
    }
}
