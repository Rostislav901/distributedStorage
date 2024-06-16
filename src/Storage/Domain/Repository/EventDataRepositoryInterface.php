<?php

namespace App\Storage\Domain\Repository;

use App\Storage\Domain\Entity\Event;

interface EventDataRepositoryInterface
{
    public function add(Event $data): string; // return ulid

    /**
     * @return Event[]
     */
    public function getAllEventsByCreatorUlid(string $creator_ulid): array;

    public function deleteByTitleAndCreatorUlid(string $title, string $creator_ulid): bool;
}
