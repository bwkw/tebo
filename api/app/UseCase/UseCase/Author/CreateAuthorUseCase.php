<?php

namespace App\Usecase\Usecase\Author;

use App\Domain\DTO\AuthorDto;
use App\Domain\Entity\AuthorEntity;
use App\Domain\RepositoryInterface\AuthorRepositoryInterface;

class CreateAuthorUseCase
{
    private AuthorRepositoryInterface $authorRepository;

    public function __construct(AuthorRepositoryInterface $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    public function execute(AuthorEntity $authorEntity): AuthorDto
    {
        return $this->authorRepository->save($authorEntity);
    }
}
