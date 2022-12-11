<?php

namespace App\Domain\RepositoryInterface;

use App\Domain\DTO\AuthorBookDto;
use App\Domain\Entity\AuthorBookEntity;

interface AuthorBookRepositoryInterface
{
    public function save(AuthorBookEntity $authorBookEntity): AuthorBookDto;
}
