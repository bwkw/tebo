<?php

namespace App\Usecase\Usecase\Publisher;

use App\Domain\DomainService\PublisherDomainService;
use App\Domain\DTO\PublisherDto;
use App\Domain\Entity\PublisherEntity;
use App\Domain\RepositoryInterface\PublisherRepositoryInterface;

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
        if ($this->publisherDomainService->Exists($publisherEntity)) {
            return $this->publisherRepository->getByName($publisherEntity->name);
        }
        return $this->publisherRepository->save($publisherEntity);
    }
}
