<?php

namespace App\Storage\Infrastructure\Repository;

use App\Storage\Domain\Entity\Event;
use App\Storage\Domain\Repository\EventDataRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;

class EventEventDataRepository extends EntityRepository implements EventDataRepositoryInterface
{
    private readonly EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $class = new ClassMetadata(Event::class);

        parent::__construct($em, $class);
    }

    public function add(Event $data): string
    {
        $this->em->persist($data);
        $this->em->flush();

        return $data->getUlid();
    }

    public function removeByUlid(string $ulid): void
    {
        $this->em->remove($this->findOneBy(['ulid' => $ulid]));
        $this->em->flush();
    }

    public function findAllData(): array
    {
        return parent::findAll();
    }

    public function getAllEventsByCreatorUlid(string $creator_ulid): array
    {
        return $this->findBy(['creator_ulid' => $creator_ulid]);
    }

    public function deleteByTitleAndCreatorUlid(string $title, string $creator_ulid): bool
    {
        $res = $event = $this->findOneBy(['title' => $title, 'creator_ulid' => $creator_ulid]);

        $this->em->remove($event);
        $this->em->flush();

        return null !== $res;
    }
}
