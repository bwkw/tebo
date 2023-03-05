<?php

namespace App\Infrastructure\Repository\RDB;

use App\Domain\Publisher\PublisherDto;
use App\Domain\Publisher\PublisherEntity;
use App\Domain\Publisher\PublisherRepositoryInterface;
use App\Infrastructure\ORM\PublisherOrm;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PublisherRepository implements PublisherRepositoryInterface
{
    public function save(PublisherEntity $publisherEntity): PublisherDto
    {
        /** @var PublisherOrm $publisherOrm */
        $publisherOrm = PublisherOrm::query()->create(
            [
                "name" => $publisherEntity->name,
            ]
        );
        $reconstructedPublisherEntity = PublisherEntity::reconstructFromRepository(
            $publisherOrm->id,
            $publisherOrm->name,
        );
        return $reconstructedPublisherEntity->toDto();
    }

    /**
     * @param string $name
     * @return PublisherDto
     * @throws ModelNotFoundException
     */
    public function getByName(string $name): PublisherDto
    {
        /** @var PublisherOrm $publisherOrm */
        $publisherOrm = PublisherOrm::query()->where("name", $name)->firstOrFail();
        $reconstructedPublisherEntity = PublisherEntity::reconstructFromRepository(
            $publisherOrm->id,
            $publisherOrm->name,
        );
        return $reconstructedPublisherEntity->toDto();
    }
}
