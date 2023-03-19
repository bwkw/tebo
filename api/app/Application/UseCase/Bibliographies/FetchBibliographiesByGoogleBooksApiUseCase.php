<?php

namespace App\Application\UseCase\Bibliographies;

use Carbon\CarbonImmutable;

class FetchBibliographiesByGoogleBooksApiUseCase
{
    /**
     * @param string $keyword
     * @param int $count
     * @return array
     */
    public function execute(string $keyword, int $count): array
    {
        $maxResults = 10;
        $googleBooksApiBaseUrl = 'https://www.googleapis.com/books/v1/volumes';
        $openBdApiBaseUrl = 'https://api.openbd.jp/v1/get?isbn=';
        $googleBooksApiBaseUrl .= '?q=' . $keyword . '&maxResults=' . $maxResults;

        $bibliographies = [];
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
                $title = $result->volumeInfo->title;
                $description = $result->volumeInfo->description ?? ""; //説明はGoogleBooksApiで十分そう
                $coverImageUrl = $summary->cover ?? "";
                $page = $result->volumeInfo->pageCount ?? 0; //ページ数はGoogleBooksApiの方がデータ持ってる
                $publishedDate =
                    new CarbonImmutable($result->volumeInfo->publishedDate) ??
                    new CarbonImmutable("99991231");
                $authors = $result->volumeInfo->authors ?? [null]; //著者はGoogleBooksApiの方がデータ持ってる

                foreach ($authors as $author) {
                    $bibliography = [
                        'title' => $title,
                        'description' => $description,
                        'coverImageUrl' => $coverImageUrl,
                        'page' => $page,
                        'publishedDate' => $publishedDate,
                        'publisher' => $publisher,
                        'author' => $author
                    ];
                    $bibliographies[] = $bibliography;
                }
            }
            sleep(2);
        }

        return $bibliographies;
    }
}
