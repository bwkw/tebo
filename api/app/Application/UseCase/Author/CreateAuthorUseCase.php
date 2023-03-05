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
     * @param AuthorEntity $authorEntity
     * @return AuthorDto
     */
    public function execute(AuthorEntity $authorEntity): AuthorDto
    {
        if ($this->authorDomainService->exists($authorEntity)) {
            return $this->authorRepository->getByName($authorEntity->name);
        }
        return $this->authorRepository->save($authorEntity);
    }
}
