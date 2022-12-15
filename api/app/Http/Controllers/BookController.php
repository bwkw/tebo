<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookResource;
use App\Infrastructure\ORM\BookOrm;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class BookController extends Controller
{
    public function fetchBooks(): AnonymousResourceCollection
    {
        return BookResource::collection(BookOrm::all());
    }

    public function fetchBook(int $bookId): BookResource
    {
        return new BookResource(BookOrm::query()->findOrFail($bookId));
    }
}
