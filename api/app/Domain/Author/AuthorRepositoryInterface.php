<?php

namespace App\Domain\Author;

interface AuthorRepositoryInterface
{
    public function save(AuthorEntity $authorEntity): AuthorDto;
    public function getByName(string $name): AuthorDto;
}
