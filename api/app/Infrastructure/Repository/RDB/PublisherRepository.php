<?php

namespace App\Infrastructure\Repository\RDB;

use App\Domain\DTO\PublisherDto;
use App\Domain\Entity\PublisherEntity;
use App\Domain\RepositoryInterface\PublisherRepositoryInterface;
use App\Infrastructure\ORM\PublisherOrm;

class PublisherRepository implements PublisherRepositoryInterface
{
    public function save(PublisherEntity $publisherEntity): PublisherDto
    {
        /** @var PublisherOrm $publisherOrm */
        $publisherOrm = PublisherOrm::query()->create(
            [
                "name" => $publisherEntity->name(),
            ]
        );
        $reconstructedPublisherEntity = PublisherEntity::reconstructFromRepository($publisherOrm->id, $publisherOrm->name);
        return $reconstructedPublisherEntity->toDto();
    }
}
