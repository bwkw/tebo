<?php

namespace App\Domain\Publisher;

interface PublisherRepositoryInterface
{
    public function save(PublisherEntity $publisherEntity): PublisherDto;
    public function getByName(string $name): PublisherDto;
}
