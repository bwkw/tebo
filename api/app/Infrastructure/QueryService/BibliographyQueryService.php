<?php

namespace App\Infrastructure\QueryService;

use App\Application\DTO\BibliographyDto;
use App\Application\QueryServiceInterface\BibliographyQueryServiceInterface;
use App\Domain\Author\AuthorRepositoryInterface;
use App\Domain\AuthorBook\AuthorBookRepositoryInterface;
use App\Domain\Book\BookRepositoryInterface;
use App\Domain\Publisher\PublisherRepositoryInterface;

class BibliographyQueryService implements BibliographyQueryServiceInterface
{
    private AuthorRepositoryInterface $authorRepository;
    private AuthorBookRepositoryInterface $authorBookRepository;
    private BookRepositoryInterface $bookRepository;
    private PublisherRepositoryInterface $publisherRepository;

    public function __construct(
        AuthorRepositoryInterface $authorRepository,
        AuthorBookRepositoryInterface $authorBookRepository,
        BookRepositoryInterface $bookRepository,
        PublisherRepositoryInterface $publisherRepository
    ) {
        $this->authorRepository = $authorRepository;
        $this->authorBookRepository = $authorBookRepository;
        $this->bookRepository = $bookRepository;
        $this->publisherRepository = $publisherRepository;
    }

    /**
     * @return BibliographyDto[]
     */
    public function fetchAll(): array
    {
        $bibliographyDtos = [];

        $bookDtos = $this->bookRepository->fetchAll();
        foreach ($bookDtos as $bookDto) {
            $id = $bookDto->id;
            $title = $bookDto->title;
            $description = $bookDto->description;
            $coverImageUrl = $bookDto->coverImageUrl;
            $page = $bookDto->page;
            $publishedDate = $bookDto->publishedDate;
            $publisherId = $bookDto->publisherId;
            if ($publisherId) {
                $publisherDto = $this->publisherRepository->fetchById($publisherId);
                $publisher = $publisherDto->name;
            } else {
                $publisher = null;
            }
            $authors = [];
            $authorBookDtos = $this->authorBookRepository->fetchByBookId($id);
            if ($authorBookDtos) {
                foreach ($authorBookDtos as $authorBookDto) {
                    if ($authorBookDto->authorId) {
                        $authorDto = $this->authorRepository->fetchById($authorBookDto->authorId);
                        $authors[] = $authorDto->name;
                    }
                }
            } else {
                $authors = null;
            }
            $bibliographyDto = new BibliographyDto(
                $id,
                $title,
                $description,
                $coverImageUrl,
                $page,
                $publishedDate,
                $publisher,
                $authors,
            );
            $bibliographyDtos[] = $bibliographyDto;
        }

        return $bibliographyDtos;
    }
}
