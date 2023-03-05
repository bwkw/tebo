<?php

namespace App\Domain\Book;

interface BookRepositoryInterface
{
    public function save(BookEntity $bookEntity): BookDto;
    public function getByTitle(string $title): BookDto;
}
