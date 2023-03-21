<?php

namespace App\Application\QueryServiceInterface;

use App\Application\DTO\BibliographyDto;

interface BibliographyQueryServiceInterface
{
    /**
     * @return BibliographyDto[]
     */
    public function fetchAll(): array;
    public function fetchByBibliographyId(int $bibliographyId): BibliographyDto;
}
