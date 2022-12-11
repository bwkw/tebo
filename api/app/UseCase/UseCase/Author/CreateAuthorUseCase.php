<?php

namespace App\Usecase\Usecase\Author;

use App\Domain\DomainService\AuthorDomainService;
use App\Domain\DTO\AuthorDto;
use App\Domain\Entity\AuthorEntity;
use App\Domain\RepositoryInterface\AuthorRepositoryInterface;

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
        if ($this->authorDomainService->Exists($authorEntity)) {
            return $this->authorRepository->getByName($authorEntity->name());
        }
        return $this->authorRepository->save($authorEntity);
    }
}
