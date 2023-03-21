<?php

namespace App\Application\UseCase\Bibliography;

use A\B;
use App\Application\DTO\BibliographyDto;
use App\Application\QueryServiceInterface\BibliographyQueryServiceInterface;

class FetchBibliographyUseCase
{
    private BibliographyQueryServiceInterface $biographyQueryService;

    public function __construct(
        BibliographyQueryServiceInterface $bibliographyQueryService,
    ) {
        $this->biographyQueryService = $bibliographyQueryService;
    }

    /**
     * @param int $bibliographyId
     *
     * @return BibliographyDto
     */
    public function execute(int $bibliographyId): BibliographyDto
    {
        return $this->biographyQueryService->fetchByBibliographyId($bibliographyId);
    }
}
