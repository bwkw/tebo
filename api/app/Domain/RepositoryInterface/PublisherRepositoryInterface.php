<?php
namespace App\Domain\RepositoryInterface;

use App\Domain\Entity\PublisherEntity;

interface PublisherRepositoryInterface
{
    public function save(PublisherEntity $publisherEntity): void;
}
