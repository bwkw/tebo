<?php

namespace App\Domain\AuthorBook;

interface AuthorBookRepositoryInterface
{
    public function save(AuthorBookEntity $authorBookEntity): AuthorBookDto;
    public function fetchByAuthorIdBookId(?int $authorId, int $bookId): AuthorBookDto;
    /**
     * @param int $bookId
     * @return AuthorBookDto[]|null
     */
    public function fetchByBookId(int $bookId): array|null;
}
