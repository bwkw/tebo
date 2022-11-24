<?php

namespace App\Console\Commands;

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
    protected $description = 'Create Books By Api';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        $keyword = 'IT';
        $maxResults = 40;
        $baseUrl = 'https://www.googleapis.com/books/v1/volumes';
        $baseUrl .= '?q=' . $keyword . '&maxResults=' . $maxResults;

        $itBooks = [];
        for ($i=0; $i<5; $i++) {
            $startIndex = $maxResults * $i;
            $searchUrl = $baseUrl . '&startIndex=' . $startIndex;
            $results = json_decode(file_get_contents($searchUrl))->items;
            foreach ($results as $result) {
                $itBook = [];
                $itBook['title'] = $result->volumeInfo->title;
                $itBook['authors'] = $result->volumeInfo->authors ?? null;
                $itBook['publisher'] = $result->publisher ?? null;
                $itBook['publishedDate'] = $result->pulishedDate ?? null;
                $itBook['description'] = $result->description ?? null;
                // S3に画像保存してそのURLを挿入する
//                $imageUrl = $result->imageLinks->thumbnail;
//                $itBook['imageUrl'] = FIXME: S3のURL
                $itBooks[] = $itBook;
            }
            sleep(2);
        }
    }

}
