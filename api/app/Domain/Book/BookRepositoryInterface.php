<?php

namespace App\Domain\Book;

interface BookRepositoryInterface
{
    public function save(BookEntity $bookEntity): BookDto;
    /**
     * @return BookDto[]
     */
    public function fetchAll(): array;
    public function fetchByTitle(string $title): BookDto;
}
