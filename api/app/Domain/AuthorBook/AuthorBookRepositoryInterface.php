<?php

namespace App\Domain\AuthorBook;

interface AuthorBookRepositoryInterface
{
    public function save(AuthorBookEntity $authorBookEntity): AuthorBookDto;
}
