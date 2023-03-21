<?php

namespace App\Application\UseCase\Author;

use App\Domain\Author\AuthorDomainService;
use App\Domain\Author\AuthorDto;
use App\Domain\Author\AuthorEntity;
use App\Domain\Author\AuthorRepositoryInterface;

class CreateAuthorUseCase
{
    private AuthorRepositoryInterface $authorRepository;
    private AuthorDomainService $authorDomainService;

    public function __construct(
        AuthorRepositoryInterface $authorRepository,
        AuthorDomainService $authorDomainService,
    ) {
        $this->authorRepository = $authorRepository;
        $this->authorDomainService = $authorDomainService;
    }

    /**
     * @param string $author
     *
     * @return AuthorDto
     */
    public function execute(string $author): AuthorDto
    {
        $authorEntity = AuthorEntity::constructNewInstance($author);

        if ($this->authorDomainService->exists($authorEntity)) {
            return $this->authorRepository->fetchByName($authorEntity->name);
        }
        return $this->authorRepository->save($authorEntity);
    }
}
