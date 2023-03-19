<?php

namespace App\Console\Commands;

use App\Application\UseCase\Bibliographies\CreateBibliographyUseCase;
use App\Application\UseCase\Bibliographies\FetchbibliographiesByGoogleBooksApiUseCase;
use Illuminate\Console\Command;

class CreateBooks extends Command
{
    protected $signature = 'books:create {keyword}';
    protected $description = 'Create Book By Api';
    private CreateBibliographyUseCase $createBibliographyUseCase;
    private FetchBibliographiesByGoogleBooksApiUseCase $fetchBibliographiesByGoogleBooksApiUseCase;

    public function __construct(
        CreateBibliographyUseCase $createBibliographyUseCase,
        FetchBibliographiesByGoogleBooksApiUseCase $fetchBibliographiesByGoogleBooksApiUseCase
    ) {
        parent::__construct();
        $this->createBibliographyUseCase = $createBibliographyUseCase;
        $this->fetchBibliographiesByGoogleBooksApiUseCase = $fetchBibliographiesByGoogleBooksApiUseCase;
    }

    public function handle(): void
    {
        $keyword = $this->argument('keyword');
        $count = 10;

        $bibliographies = $this->fetchBibliographiesByGoogleBooksApiUseCase->execute($keyword, $count);
        foreach ($bibliographies as $bibliography) {
            $publisher = $bibliography['publisher'];
            $author = $bibliography['author'];
            $title = $bibliography['title'];
            $description = $bibliography['description'];
            $coverImageUrl = $bibliography['coverImageUrl'];
            $page = $bibliography['page'];
            $publishedDate = $bibliography['publishedDate'];

            $this->createBibliographyUseCase->execute(
                $publisher,
                $author,
                $title,
                $description,
                $coverImageUrl,
                $page,
                $publishedDate,
            );
        }
    }
}
