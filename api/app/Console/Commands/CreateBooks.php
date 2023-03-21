<?php

namespace App\Console\Commands;

use App\Application\UseCase\Bibliography\CreateBibliographyUseCase;
use App\Application\UseCase\Bibliography\FetchbibliographiesByGoogleBooksApiUseCase;
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
            $title = $bibliography['title'];
            $description = $bibliography['description'];
            $coverImageUrl = $bibliography['coverImageUrl'];
            $page = $bibliography['page'];
            $publishedDate = $bibliography['publishedDate'];
            $publisher = $bibliography['publisher'];
            $authors = $bibliography['authors'];

            $this->createBibliographyUseCase->execute(
                $title,
                $description,
                $coverImageUrl,
                $page,
                $publishedDate,
                $publisher,
                $authors,
            );
        }
    }
}
