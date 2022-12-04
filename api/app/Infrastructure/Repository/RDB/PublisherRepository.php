<?php

namespace App\Infrastructure\Repository\RDB;

use App\Domain\DTO\PublisherDto;
use App\Domain\RepositoryInterface\PublisherRepositoryInterface;
use App\Infrastructure\ORM\PublisherOrm;

class PublisherRepository implements PublisherRepositoryInterface
{
    private PublisherOrm $publisherOrm;

    private function __construct(PublisherOrm $publisherOrm)
    {
        $this->publisherOrm = $publisherOrm;
    }

    public function save(PublisherDto $publisherDto): void
    {
        $this->publisherOrm->query()->create(
            [
                "name" => $publisherDto->name,
            ]
        );
    }
}
