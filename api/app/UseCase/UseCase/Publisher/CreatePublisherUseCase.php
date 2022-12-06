<?php

namespace App\Usecase\Usecase\Publisher;

use App\Domain\Entity\PublisherEntity;
use App\Domain\RepositoryInterface\PublisherRepositoryInterface;

class CreatePublisherUseCase
{
    private PublisherRepositoryInterface $publisherRepository;

    public function __construct(PublisherRepositoryInterface $publisherRepository)
    {
        $this->publisherRepository = $publisherRepository;
    }

    public function execute(PublisherEntity $publisherEntity): void
    {
        $this->publisherRepository->save($publisherEntity);
    }
}
