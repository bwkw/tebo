<?php
namespace App\Domain\RepositoryInterface;

use App\Domain\DTO\BookDto;

interface BookRepositoryInterface
{
    public function save(BookDto $bookDto): void;
}
