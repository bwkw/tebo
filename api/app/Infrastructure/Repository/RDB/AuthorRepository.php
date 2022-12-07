<?php

namespace App\Infrastructure\Repository\RDB;

use App\Domain\DTO\AuthorDto;
use App\Domain\Entity\AuthorEntity;
use App\Domain\RepositoryInterface\AuthorRepositoryInterface;
use App\Infrastructure\ORM\AuthorOrm;

class AuthorRepository implements AuthorRepositoryInterface
{
    public function save(AuthorEntity $authorEntity): AuthorDto
    {
        /** @var AuthorOrm $authorOrm */
        $authorOrm = AuthorOrm::query()->create(
            [
                "name" => $authorEntity->name(),
            ]
        );
        $reconstructedAuthorEntity = AuthorEntity::reconstructFromRepository($authorOrm->id, $authorOrm->name);
        return $reconstructedAuthorEntity->toDto();
    }
}
