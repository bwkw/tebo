<?php
namespace App\Domain\RepositoryInterface;

use App\Domain\DTO\PublisherDto;

interface PublisherRepositoryInterface
{
    public function save(PublisherDto $publisherDto): void;
}
