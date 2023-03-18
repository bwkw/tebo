<?php

namespace App\Application\UseCase\API;

use App\Application\UseCase\Author\CreateAuthorUseCase;
use App\Application\UseCase\AuthorBook\CreateAuthorBookUseCase;
use App\Application\UseCase\Book\CreateBookUseCase;
use App\Application\UseCase\Publisher\CreatePublisherUseCase;
use App\Domain\Author\AuthorEntity;
use App\Domain\AuthorBook\AuthorBookEntity;
use App\Domain\Book\BookEntity;
use App\Domain\Publisher\PublisherEntity;
use Carbon\CarbonImmutable;

class CallGoogleBooksApiUseCase
{
    private CreateAuthorUseCase $createAuthorUseCase;
    private CreateBookUseCase $createBookUseCase;
    private CreatePublisherUseCase $createPublisherUseCase;
    private CreateAuthorBookUseCase $createAuthorBookUseCase;

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
     * @param string $keyword
     * @param int $count
     */
    public function execute(string $keyword, int $count): void
    {
        $maxResults = 10;
        $googleBooksApiBaseUrl = 'https://www.googleapis.com/books/v1/volumes';
        $openBdApiBaseUrl = 'https://api.openbd.jp/v1/get?isbn=';
        $googleBooksApiBaseUrl .= '?q=' . $keyword . '&maxResults=' . $maxResults;

        $iterationCount = floor($count / $maxResults);

        for ($i = 0; $i <= $iterationCount; $i++) {
            $startIndex = $maxResults * $i; // $startIndexは0始まり
            $googleBooksApiUrl = $googleBooksApiBaseUrl . '&startIndex=' . $startIndex;
            $results = json_decode(file_get_contents($googleBooksApiUrl))->items;
            foreach ($results as $result) {
                $industryIdentifiers = $result->volumeInfo->industryIdentifiers ?? null;
                if (!$industryIdentifiers) {
                    continue;
                }
                $newIndustryIdentifiers = array_column($industryIdentifiers, 'identifier', 'type');
                if (array_key_exists('ISBN_13', $newIndustryIdentifiers)) {
                    $isbn = $newIndustryIdentifiers['ISBN_13'];
                } elseif (array_key_exists('ISBN_10', $newIndustryIdentifiers)) {
                    $isbn = $newIndustryIdentifiers['ISBN_10'];
                } else {
                    continue;
                }

                $openBdApiUrl = $openBdApiBaseUrl . $isbn;
                if (json_decode(file_get_contents($openBdApiUrl))[0]) {
                    $summary = json_decode(file_get_contents($openBdApiUrl))[0]->summary;
                } else {
                    continue;
                }

                $publisher = $result->volumeInfo->publisher ?? null;
                if ($publisher) {
                    $publisherEntity = PublisherEntity::constructNewInstance($publisher);
                    $publisherDto = $this->createPublisherUseCase->execute($publisherEntity);
                    $publisherId = $publisherDto->id;
                } else {
                    $publisherId = null;
                }
                $title = $result->volumeInfo->title;
                $description = $result->volumeInfo->description ?? ""; //説明はGoogleBooksApiで十分そう
                $coverImageUrl = $summary->cover ?? "";
                $page = $result->volumeInfo->pageCount ?? 0; //ページ数はGoogleBooksApiの方がデータ持ってる
                $publishedDate =
                    new CarbonImmutable($result->volumeInfo->publishedDate) ??
                    new CarbonImmutable("99991231");
                $authors = $result->volumeInfo->authors ?? null; //著者はGoogleBooksApiの方がデータ持ってる
                if ($authors) {
                    foreach ($authors as $author) {
                        $authorEntity = AuthorEntity::constructNewInstance($author);
                        $authorDto = $this->createAuthorUseCase->execute($authorEntity);
                        $bookEntity = BookEntity::constructNewInstance(
                            $title,
                            $description,
                            $coverImageUrl,
                            $page,
                            $publishedDate,
                            $publisherId,
                        );
                        $bookDto = $this->createBookUseCase->execute($bookEntity);
                        $authorBookEntity = AuthorBookEntity::constructNewInstance(
                            $authorDto->id,
                            $bookDto->id,
                        );
                        $this->createAuthorBookUseCase->execute($authorBookEntity);
                    }
                } else {
                    $authorId = null;
                    $bookEntity = BookEntity::constructNewInstance(
                        $title,
                        $description,
                        $coverImageUrl,
                        $page,
                        $publishedDate,
                        $publisherId,
                    );
                    $bookDto = $this->createBookUseCase->execute($bookEntity);
                    $authorBookEntity = AuthorBookEntity::constructNewInstance($authorId, $bookDto->id);
                    $this->createAuthorBookUseCase->execute($authorBookEntity);
                }
            }
            sleep(2);
        }
    }
}
