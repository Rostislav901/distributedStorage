<?php

namespace App\Storage\Domain\Factory;

use App\Shared\Domain\Security\UserFetcherInterface;
use App\Storage\Domain\Document\Event;

class EventDocumentFactory
{
    public function __construct(private readonly UserFetcherInterface $userFetcher)
    {
    }

    public function create(
        string $title,
        string $description,
        string $location,
        \DateTime $startTime,
        \DateTime $endTime,
    ): Event {
        return (new Event())
               ->setTitle($title)
               ->setDescription($description)
               ->setLocation($location)
               ->setStartTime($startTime)
               ->setEndTime($endTime)
               ->setUserUlid($this->userFetcher->getUser()->getUlid());
    }
}
