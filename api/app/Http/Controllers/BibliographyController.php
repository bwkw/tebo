<?php

namespace App\Http\Controllers;

use App\Application\UseCase\Bibliography\CreateBibliographyUseCase;
use App\Application\UseCase\Bibliography\FetchBibliographiesByGoogleBooksApiUseCase;
use App\Application\UseCase\Bibliography\FetchBibliographiesUseCase;
use App\Application\UseCase\Bibliography\FetchBibliographyUseCase;
use App\Http\Requests\CreateBookRequest;
use App\Http\Resources\BibliographyResource;
use Symfony\Component\HttpFoundation\JsonResponse;

class BibliographyController extends Controller
{
    private CreateBibliographyUseCase $createBibliographyUseCase;
    private FetchBibliographiesByGoogleBooksApiUseCase $fetchBibliographiesByGoogleBooksApiUseCase;
    private FetchBibliographiesUseCase $fetchBibliographiesUseCase;
    private FetchBibliographyUseCase $fetchBibliographyUseCase;

    public function __construct(
        CreateBibliographyUseCase $createBibliographyUseCase,
        FetchBibliographiesByGoogleBooksApiUseCase $fetchBibliographiesByGoogleBooksApiUseCase,
        FetchBibliographiesUseCase $fetchBibliographiesUseCase,
        FetchBibliographyUseCase $fetchBibliographyUseCase
    ) {
        $this->createBibliographyUseCase = $createBibliographyUseCase;
        $this->fetchBibliographiesByGoogleBooksApiUseCase = $fetchBibliographiesByGoogleBooksApiUseCase;
        $this->fetchBibliographiesUseCase = $fetchBibliographiesUseCase;
        $this->fetchBibliographyUseCase = $fetchBibliographyUseCase;
    }

    public function fetchBibliographies(): JsonResponse
    {
        $bibliographyDtos = $this->fetchBibliographiesUseCase->execute();

        return response()->json(BibliographyResource::collection($bibliographyDtos));
    }

    public function fetchBibliography(int $bibliographyId): JsonResponse
    {
        $bibliographyDto = $this->fetchBibliographyUseCase->execute($bibliographyId);

        return response()->json(new BibliographyResource($bibliographyDto));
    }

    /**
     * @param CreateBookRequest $request
     *
     * @return JsonResponse
     */
    public function createBook(CreateBookRequest $request): JsonResponse
    {
        $title = $request->title;

        // 作成時はデータが一つなのでこうした
        $count = 1;
        $bibliographies = $this->fetchBibliographiesByGoogleBooksApiUseCase->execute($title, $count);
        $bibliography = $bibliographies[0];

        // 作成したデータをDTOに詰め込む
        $title = $bibliography['title'];
        $description = $bibliography['description'];
        $coverImageUrl = $bibliography['coverImageUrl'];
        $page = $bibliography['page'];
        $publishedDate = $bibliography['publishedDate'];
        $publisher = $bibliography['publisher'];
        $authors = $bibliography['authors'];
        $bibliographyDto = $this->createBibliographyUseCase->execute(
            $title,
            $description,
            $coverImageUrl,
            $page,
            $publishedDate,
            $publisher,
            $authors,
        );

        return response()->json(new BibliographyResource($bibliographyDto));
    }
}
