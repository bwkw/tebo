<?php

namespace App\Application\UseCase\Bibliography;

use App\Application\DTO\BibliographyDto;
use App\Application\UseCase\Author\CreateAuthorUseCase;
use App\Application\UseCase\AuthorBook\CreateAuthorBookUseCase;
use App\Application\UseCase\Book\CreateBookUseCase;
use App\Application\UseCase\Publisher\CreatePublisherUseCase;
use Carbon\CarbonImmutable;

class CreateBibliographyUseCase
{
    private CreateAuthorUseCase $createAuthorUseCase;
    private CreateAuthorBookUseCase $createAuthorBookUseCase;
    private CreateBookUseCase $createBookUseCase;
    private CreatePublisherUseCase $createPublisherUseCase;

    public function __construct(
        CreateAuthorUseCase $createAuthorUseCase,
        CreateAuthorBookUseCase $createAuthorBookUseCase,
        CreateBookUseCase $createBookUseCase,
        CreatePublisherUseCase $createPublisherUseCase,
    ) {
        $this->createAuthorUseCase = $createAuthorUseCase;
        $this->createAuthorBookUseCase = $createAuthorBookUseCase;
        $this->createBookUseCase = $createBookUseCase;
        $this->createPublisherUseCase = $createPublisherUseCase;
    }

    /**
     * @param string $title
     * @param string $description
     * @param string $coverImageUrl
     * @param int $page
     * @param CarbonImmutable $publishedDate
     * @param string|null $publisher
     * @param array|null $authors
     *
     * @return BibliographyDto
     */
    public function execute(
        string $title,
        string $description,
        string $coverImageUrl,
        int $page,
        CarbonImmutable $publishedDate,
        ?string $publisher,
        ?array $authors,
    ): BibliographyDto {
        // 出版社データの作成
        if ($publisher) {
            $publisherDto = $this->createPublisherUseCase->execute($publisher);
            $publisherId = $publisherDto->id;
        } else {
            $publisherId = null;
        }

        // 本データの作成
        $bookDto = $this->createBookUseCase->execute(
            $title,
            $description,
            $coverImageUrl,
            $page,
            $publishedDate,
            $publisherId,
        );
        $bookId = $bookDto->id;

        // 著者データの作成と本-著者データの紐付け
        if ($authors) {
            foreach ($authors as $author) {
                $authorDto = $this->createAuthorUseCase->execute($author);
                $authorId = $authorDto->id;
                $this->createAuthorBookUseCase->execute($authorId, $bookId);
            }
        }

        return new BibliographyDto(
            $bookId,
            $title,
            $description,
            $coverImageUrl,
            $page,
            $publishedDate,
            $publisher,
            $authors
        );
    }
}
