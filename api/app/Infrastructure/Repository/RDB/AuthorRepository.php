<?php

namespace App\Infrastructure\Repository\RDB;

use App\Domain\Entity\AuthorEntity;
use App\Domain\RepositoryInterface\AuthorRepositoryInterface;
use App\Infrastructure\ORM\AuthorOrm;

class AuthorRepository implements AuthorRepositoryInterface
{
    public function save(AuthorEntity $authorEntity): void
    {
        AuthorOrm::query()->create(
            [
                "name" => $authorEntity->name(),
            ]
        );
    }
}
