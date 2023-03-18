<?php

namespace App\Console\Commands;

use App\Application\UseCase\API\FetchBooksByGoogleBooksApiUseCase;
use App\Application\UseCase\Author\CreateAuthorUseCase;
use App\Application\UseCase\AuthorBook\CreateAuthorBookUseCase;
use App\Application\UseCase\Book\CreateBookUseCase;
use App\Application\UseCase\Publisher\CreatePublisherUseCase;
use Illuminate\Console\Command;

class CreateBooks extends Command
{
    protected $signature = 'books:create {keyword}';
    protected $description = 'Create Book By Api';
    private CreateAuthorUseCase $createAuthorUseCase;
    private CreateAuthorBookUseCase $createAuthorBookUseCase;
    private CreateBookUseCase $createBookUseCase;
    private CreatePublisherUseCase $createPublisherUseCase;
    private FetchBooksByGoogleBooksApiUseCase $fetchBooksByGoogleBooksApiUseCase;

    public function __construct(
        CreateAuthorUseCase $createAuthorUseCase,
        CreateAuthorBookUseCase $createAuthorBookUseCase,
        CreateBookUseCase $createBookUseCase,
        CreatePublisherUseCase $createPublisherUseCase,
        FetchBooksByGoogleBooksApiUseCase $fetchBooksByGoogleBooksApiUseCase
    ) {
        parent::__construct();
        $this->createAuthorUseCase = $createAuthorUseCase;
        $this->createAuthorBookUseCase = $createAuthorBookUseCase;
        $this->createBookUseCase = $createBookUseCase;
        $this->createPublisherUseCase = $createPublisherUseCase;
        $this->fetchBooksByGoogleBooksApiUseCase = $fetchBooksByGoogleBooksApiUseCase;
    }

    public function handle(): void
    {
        $keyword = $this->argument('keyword');
        $count = 10;

        $books = $this->fetchBooksByGoogleBooksApiUseCase->execute($keyword, $count);
        foreach ($books as $book) {
            $publisher = $book['publisher'];
            $author = $book['author'];
            $title = $book['title'];
            $description = $book['description'];
            $coverImageUrl = $book['coverImageUrl'];
            $page = $book['page'];
            $publishedDate = $book['publishedDate'];

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
}
