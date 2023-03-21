<?php

namespace App\Domain\Author;

interface AuthorRepositoryInterface
{
    public function save(AuthorEntity $authorEntity): AuthorDto;
    public function fetchById(int $id): AuthorDto;
    public function fetchByName(string $name): AuthorDto;
}
