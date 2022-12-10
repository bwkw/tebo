<?php

namespace App\Usecase\Usecase\Publisher;

use App\Domain\DomainService\PublisherDomainService;
use App\Domain\DTO\PublisherDto;
use App\Domain\Entity\PublisherEntity;
use App\Domain\RepositoryInterface\PublisherRepositoryInterface;
use App\Exceptions\ModelAlreadyExistsException;

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
     * @throws ModelAlreadyExistsException
     */
    public function execute(PublisherEntity $publisherEntity): PublisherDto
    {
        if ($this->publisherDomainService->Exists($publisherEntity)) {
            throw new ModelAlreadyExistsException($publisherEntity->name() . "は既に存在しています。");
        }
        return $this->publisherRepository->save($publisherEntity);
    }
}
