<?php

namespace App\UseCase\UseCase\Publisher;

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
     * @param PublisherEntity $publisherEntity
     * @return PublisherDto
     */
    public function execute(PublisherEntity $publisherEntity): PublisherDto
    {
        if ($this->publisherDomainService->exists($publisherEntity)) {
            return $this->publisherRepository->getByName($publisherEntity->name);
        }
        return $this->publisherRepository->save($publisherEntity);
    }
}
