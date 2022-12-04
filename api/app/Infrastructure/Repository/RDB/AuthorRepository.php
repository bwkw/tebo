<?php

namespace App\Infrastructure\Repository\RDB;

use App\Domain\DTO\AuthorDto;
use App\Domain\RepositoryInterface\AuthorRepositoryInterface;
use App\Infrastructure\ORM\AuthorOrm;

class AuthorRepository implements AuthorRepositoryInterface
{
    private AuthorOrm $authorOrm;

    private function __construct(AuthorOrm $authorOrm)
    {
        $this->authorOrm = $authorOrm;
    }

    public function save(AuthorDto $authorDto): void
    {
        $this->authorOrm->query()->create(
            [
                "name" => $authorDto->name,
            ]
        );
    }
}
