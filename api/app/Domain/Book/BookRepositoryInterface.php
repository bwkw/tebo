<?php

namespace App\Domain\Book;

interface BookRepositoryInterface
{
    public function save(BookEntity $bookEntity): BookDto;
    public function fetchByTitle(string $title): BookDto;
}
