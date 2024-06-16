<?php

namespace App\Storage\Domain\Service;

use App\Storage\Domain\Entity\Event;
use App\Storage\Domain\Factory\EventEntityFactory;
use App\Storage\Domain\Repository\EventDataRepositoryInterface;
use Doctrine\Persistence\ManagerRegistry;

class EventEntityMaker
{
    public function __construct(private readonly ManagerRegistry $managerRegistry, private readonly EventEntityFactory $factory)
    {
    }

    public function makeEventEntity(
        string $title, string $description,
        string $location, int $startTime, int $endTime,
        string $fileName, string $creator_ulid, string $fileId, int $filesize): void
    {
        $event = $this->factory->create(
            $title, $description,
            $location, $startTime,
            $endTime, $fileName, $creator_ulid,
            $fileId, $filesize
        );
        /**
         * @var EventDataRepositoryInterface $repository
         */
        $repository = $this->managerRegistry->getRepository(Event::class, 'default');

        $repository->add($event);
    }
}
