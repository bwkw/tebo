<?php
namespace App\Domain\RepositoryInterface;

use App\Domain\DTO\AuthorDto;

interface AuthorRepositoryInterface
{
    public function save(AuthorDto $authorDto): void;
}
