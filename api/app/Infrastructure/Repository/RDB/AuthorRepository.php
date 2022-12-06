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
        /** @var AuthorOrm $author */
        $author = AuthorOrm::query()->create(
            [
                "name" => $authorEntity->name(),
            ]
        );

        return new AuthorDto($author->id, $author->name);
    }
}
