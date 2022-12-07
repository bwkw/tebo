<?php
namespace App\Domain\RepositoryInterface;

use App\Domain\DTO\BookDto;
use App\Domain\Entity\BookEntity;

interface BookRepositoryInterface
{
    public function save(BookEntity $bookEntity): BookDto;
}
