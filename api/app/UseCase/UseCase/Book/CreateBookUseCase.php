<?php

namespace App\Usecase\Usecase\Book;

use App\Domain\DTO\BookDto;
use App\Domain\Entity\BookEntity;
use App\Domain\RepositoryInterface\BookRepositoryInterface;

class CreateBookUseCase
{
    private BookRepositoryInterface $authorRepository;

    public function __construct(BookRepositoryInterface $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    public function execute(BookEntity $authorEntity): BookDto
    {
        return $this->authorRepository->save($authorEntity);
    }
}

