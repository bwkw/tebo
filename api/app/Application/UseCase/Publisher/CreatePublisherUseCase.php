<?php

namespace App\Application\UseCase\Publisher;

use App\Domain\Publisher\PublisherDomainService;
use App\Domain\Publisher\PublisherDto;
use App\Domain\Publisher\PublisherEntity;
use App\Domain\Publisher\PublisherRepositoryInterface;

class CreatePublisherUseCase
{
    private PublisherRepositoryInterface $publisherRepository;
    private PublisherDomainService $publisherDomainService;

    public function __construct(
        PublisherRepositoryInterface $publisherRepository,
        PublisherDomainService $publisherDomainService
    ) {
        $this->publisherRepository = $publisherRepository;
        $this->publisherDomainService = $publisherDomainService;
    }

    /**
     * @param string $publisher
     *
     * @return PublisherDto
     */
    public function execute(string $publisher): PublisherDto
    {
        $publisherEntity = PublisherEntity::constructNewInstance($publisher);

        if ($this->publisherDomainService->exists($publisherEntity)) {
            return $this->publisherRepository->fetchByName($publisherEntity->name);
        }
        return $this->publisherRepository->save($publisherEntity);
    }
}
