<?php

namespace App\Usecase\Usecase\Author;

use App\Domain\Entity\AuthorEntity;
use App\Domain\RepositoryInterface\AuthorRepositoryInterface;

class CreateAuthorUseCase
{
    private AuthorRepositoryInterface $authorRepository;

    public function __construct(AuthorRepositoryInterface $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    public function execute(AuthorEntity $authorEntity): void
    {
        $this->authorRepository->save($authorEntity);
    }
}
