<?php

namespace App\Domain\Publisher;

interface PublisherRepositoryInterface
{
    public function save(PublisherEntity $publisherEntity): PublisherDto;
    public function fetchById(int $id): PublisherDto;
    public function fetchByName(string $name): PublisherDto;
}
