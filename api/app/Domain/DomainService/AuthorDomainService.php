<?php

namespace App\Domain\DomainService;

use App\Domain\Entity\AuthorEntity;
use App\Domain\RepositoryInterface\AuthorRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AuthorDomainService
{
    private AuthorRepositoryInterface $authorRepository;

    public function __construct(AuthorRepositoryInterface $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    /**
     * @param AuthorEntity $authorEntity
     * @return bool
     */
    public function Exists(AuthorEntity $authorEntity): bool
    {
        try {
            $author = $this->authorRepository->getByName($authorEntity->name());
            return true;
        } catch (ModelNotFoundException $e) {
            return false;
        }
    }
}