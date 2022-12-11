<?php

namespace App\Console\Commands;

use App\Domain\Entity\AuthorBookEntity;
use App\Domain\Entity\AuthorEntity;
use App\Domain\Entity\BookEntity;
use App\Domain\Entity\PublisherEntity;
use App\Usecase\Usecase\Author\CreateAuthorUseCase;
use App\Usecase\Usecase\AuthorBook\CreateAuthorBookUseCase;
use App\Usecase\Usecase\Book\CreateBookUseCase;
use App\Usecase\Usecase\Publisher\CreatePublisherUseCase;
use Carbon\CarbonImmutable;
use Illuminate\Console\Command;

class CreateBooks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'books:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Book By Api';
    private CreateAuthorUseCase $createAuthorUseCase;
    private CreateBookUseCase $createBookUseCase;
    private CreatePublisherUseCase $createPublisherUseCase;
    private CreateAuthorBookUseCase $createAuthorBookUseCase;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(
        CreateAuthorUseCase $createAuthorUseCase,
        CreateAuthorBookUseCase $createAuthorBookUseCase,
        CreateBookUseCase $createBookUseCase,
        CreatePublisherUseCase $createPublisherUseCase,
    ) {
        parent::__construct();
        $this->createAuthorUseCase = $createAuthorUseCase;
        $this->createAuthorBookUseCase = $createAuthorBookUseCase;
        $this->createBookUseCase = $createBookUseCase;
        $this->createPublisherUseCase = $createPublisherUseCase;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        $keyword = 'ドメイン駆動設計';
        $maxResults = 1;
        $googleBooksApiBaseUrl = 'https://www.googleapis.com/books/v1/volumes';
        $openBdApiBaseUrl = 'https://api.openbd.jp/v1/get?isbn=';
        $googleBooksApiBaseUrl .= '?q=' . $keyword . '&maxResults=' . $maxResults;

        for ($i=0; $i<5; $i++) {
            $startIndex = $maxResults * $i;
            $googleBooksApiUrl = $googleBooksApiBaseUrl . '&startIndex=' . $startIndex;
            $results = json_decode(file_get_contents($googleBooksApiUrl))->items;
            foreach ($results as $result) {
//                todo: APIでキーワード（Java, テスト等)も取れるのでいつか使う
//                $industryIdentifiers = $result->volumeInfo->industryIdentifiers ?? null;
//                if (!$industryIdentifiers) continue;
//                $newIndustryIdentifiers = array_column($industryIdentifiers, 'identifier', 'type');
//                if (array_key_exists('ISBN_13', $newIndustryIdentifiers)) {
//                    $isbn = $newIndustryIdentifiers['ISBN_13'];
//                } elseif (array_key_exists('ISBN_10', $newIndustryIdentifiers)) {
//                    $isbn = $newIndustryIdentifiers['ISBN_10'];
//                } else {
//                    continue;
//                }
//                $openBdApiUrl = $openBdApiBaseUrl . $isbn;
//                $summary = json_decode(file_get_contents($openBdApiUrl))[0]->summary;

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
                $coverImageUrl = $result->volumeInfo->imageLinks->thumbnail ?? "";
                $page = $result->volumeInfo->pageCount ?? 0; //ページ数はGoogleBooksApiの方がデータ持ってる
                $publishedDate = new CarbonImmutable($result->volumeInfo->publishedDate) ?? new CarbonImmutable("99991231");
                $authors = $result->volumeInfo->authors ?? null; //著者はGoogleBooksApiの方がデータ持ってる
                if ($authors) {
                    foreach ($authors as $author) {
                        $authorEntity = AuthorEntity::constructNewInstance($author);
                        $authorDto = $this->createAuthorUseCase->execute($authorEntity);
                        $bookEntity = BookEntity::constructNewInstance($title, $description, $coverImageUrl, $page, $publishedDate, $publisherId);
                        $bookDto = $this->createBookUseCase->execute($bookEntity);
                        $authorBookEntity = AuthorBookEntity::constructNewInstance($authorDto->id, $bookDto->id);
                        $this->createAuthorBookUseCase->execute($authorBookEntity);
                    }
                } else {
                    $authorId = null;
                    $bookEntity = BookEntity::constructNewInstance($title, $description, $coverImageUrl, $page, $publishedDate, $publisherId);
                    $bookDto = $this->createBookUseCase->execute($bookEntity);
                    $authorBookEntity = AuthorBookEntity::constructNewInstance($authorId, $bookDto->id);
                    $this->createAuthorBookUseCase->execute($authorBookEntity);
                }
            }
            sleep(2);
        }
    }
}
