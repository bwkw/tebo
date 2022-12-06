<?php

namespace App\Infrastructure\Repository\RDB;

use App\Domain\Entity\PublisherEntity;
use App\Domain\RepositoryInterface\PublisherRepositoryInterface;
use App\Infrastructure\ORM\PublisherOrm;

class PublisherRepository implements PublisherRepositoryInterface
{
    public function save(PublisherEntity $publisherEntity): void
    {
        PublisherOrm::query()->create(
            [
                "name" => $publisherEntity->name(),
            ]
        );
    }
}
