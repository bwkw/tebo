<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookResource;
use App\Infrastructure\ORM\BookOrm;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class BookController extends Controller
{
    public function fetchBooks(): AnonymousResourceCollection
    {
        $bibliographies = $this->fetchBibliographiesUseCase->execute();

        return response()->json(BibliographyResource::collection($bibliographies));
    }

    public function fetchBook(int $bookId): BookResource
    {
        return new BookResource(BookOrm::query()->findOrFail($bookId));
    }
}
