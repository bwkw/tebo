<?php

namespace App\Infrastructure\Repository\RDB;

use App\Domain\DTO\AuthorDto;
use App\Domain\Entity\AuthorEntity;
use App\Domain\RepositoryInterface\AuthorRepositoryInterface;
use App\Infrastructure\ORM\AuthorOrm;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AuthorRepository implements AuthorRepositoryInterface
{
    /**
     * @param AuthorEntity $authorEntity
     * @return AuthorDto
     */
    public function save(AuthorEntity $authorEntity): AuthorDto
    {
        /** @var AuthorOrm $authorOrm */
        $authorOrm = AuthorOrm::query()->create(
            [
                "name" => $authorEntity->name,
            ]
        );
        $reconstructedAuthorEntity = AuthorEntity::reconstructFromRepository(
            $authorOrm->id,
            $authorOrm->name,
        );
        return $reconstructedAuthorEntity->toDto();
    }

    /**
     * @param string $name
     * @return AuthorDto
     * @throws ModelNotFoundException
     */
    public function getByName(string $name): AuthorDto
    {
        /** @var AuthorOrm $authorOrm */
        $authorOrm = AuthorOrm::query()->where("name", $name)->firstOrFail();
        $reconstructedAuthorEntity = AuthorEntity::reconstructFromRepository($authorOrm->id, $authorOrm->name);
        return $reconstructedAuthorEntity->toDto();
    }
}
