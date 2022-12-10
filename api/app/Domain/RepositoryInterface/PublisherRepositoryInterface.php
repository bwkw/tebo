<?php

namespace App\Domain\RepositoryInterface;

use App\Domain\DTO\PublisherDto;
use App\Domain\Entity\PublisherEntity;

interface PublisherRepositoryInterface
{
    public function save(PublisherEntity $publisherEntity): PublisherDto;
    public function getByName(string $name): PublisherDto;
}
