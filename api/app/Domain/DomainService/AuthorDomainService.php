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
    public function exists(AuthorEntity $authorEntity): bool
    {
        try {
            $this->authorRepository->getByName($authorEntity->name);
            return true;
        } catch (ModelNotFoundException) {
            return false;
        }
    }
}
