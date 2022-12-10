<?php

namespace App\Domain\DomainService;

use App\Domain\Entity\PublisherEntity;
use App\Domain\RepositoryInterface\PublisherRepositoryInterface;
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
    public function Exists(PublisherEntity $publisherEntity): bool
    {
        try {
            $publisher = $this->publisherRepository->getByName($publisherEntity->name());
            return true;
        } catch (ModelNotFoundException $e) {
            return false;
        }
    }
}
