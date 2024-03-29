<?php

namespace App\Infrastructure\Repository\RDB;

use App\Domain\Author\AuthorDto;
use App\Domain\Author\AuthorEntity;
use App\Domain\Author\AuthorRepositoryInterface;
use App\Infrastructure\ORM\AuthorOrm;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AuthorRepository implements AuthorRepositoryInterface
{
    /**
     * @param AuthorEntity $authorEntity
     *
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
     * @param int $id
     *
     * @return AuthorDto
     * @throws ModelNotFoundException
     */
    public function fetchById(int $id): AuthorDto
    {
        /** @var AuthorOrm $authorOrm */
        $authorOrm = AuthorOrm::query()->findOrFail($id);
        $reconstructedAuthorEntity = AuthorEntity::reconstructFromRepository($authorOrm->id, $authorOrm->name);

        return $reconstructedAuthorEntity->toDto();
    }

    /**
     * @param string $name
     *
     * @return AuthorDto
     * @throws ModelNotFoundException
     */
    public function fetchByName(string $name): AuthorDto
    {
        /** @var AuthorOrm $authorOrm */
        $authorOrm = AuthorOrm::query()->where("name", $name)->firstOrFail();
        $reconstructedAuthorEntity = AuthorEntity::reconstructFromRepository($authorOrm->id, $authorOrm->name);

        return $reconstructedAuthorEntity->toDto();
    }
}
