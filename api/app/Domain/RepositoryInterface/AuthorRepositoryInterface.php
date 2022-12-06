<?php
namespace App\Domain\RepositoryInterface;

use App\Domain\Entity\AuthorEntity;

interface AuthorRepositoryInterface
{
    public function save(AuthorEntity $authorEntity): void;
}
