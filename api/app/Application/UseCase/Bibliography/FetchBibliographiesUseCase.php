<?php

namespace App\Application\UseCase\Bibliography;

use App\Application\DTO\BibliographyDto;
use App\Application\QueryServiceInterface\BibliographyQueryServiceInterface;

class FetchBibliographiesUseCase
{
    private BibliographyQueryServiceInterface $biographyQueryService;

    public function __construct(
        BibliographyQueryServiceInterface $bibliographyQueryService,
    ) {
        $this->biographyQueryService = $bibliographyQueryService;
    }

    /**
     * @return BibliographyDto[]
     */
    public function execute(): array
    {
        return $this->biographyQueryService->fetchAll();
    }
}
