<?php

namespace App\Application\UseCase\Bibliographies;

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
     * @param string|null $publisher
     * @param string|null $author
     * @param string $title
     * @param string $description
     * @param string $coverImageUrl
     * @param int $page
     * @param CarbonImmutable $publishedDate
     *
     * @return void
     */
    public function execute(
        ?string $publisher,
        ?string $author,
        string $title,
        string $description,
        string $coverImageUrl,
        int $page,
        CarbonImmutable $publishedDate,
    ): void {
        // 出版社データの作成
        if ($publisher) {
            $publisherDto = $this->createPublisherUseCase->execute($publisher);
            $publisherId = $publisherDto->id;
        } else {
            $publisherId = null;
        }

        // 著者データの作成
        if ($author) {
            $authorDto = $this->createAuthorUseCase->execute($author);
            $authorId = $authorDto->id;
        } else {
            $authorId = null;
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

        // 著者と本データの紐付け
        $this->createAuthorBookUseCase->execute(
            $authorId,
            $bookId,
        );
    }
}
