<?php

namespace App\Domain\Publisher;

use Illuminate\Database\Eloquent\ModelNotFoundException;

class PublisherDomainService
{
    private PublisherRepositoryInterface $publisherRepository;

    public function __construct(PublisherRepositoryInterface $publisherRepository)
    {
        $this->publisherRepository = $publisherRepository;
    }

    /**
     * @param PublisherEntity $publisherEntity
     * @return bool
     */
    public function exists(PublisherEntity $publisherEntity): bool
    {
        try {
            $this->publisherRepository->fetchByName($publisherEntity->name);
            return true;
        } catch (ModelNotFoundException) {
            return false;
        }
    }
}
