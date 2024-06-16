<?php

namespace App\Storage\Domain\Repository;

use App\Storage\Domain\Entity\Event;

interface DataRepositoryInterface
{
    public function add(Event $data): string; // return ulid

    /**
     * @param string $creator_ulid
     * @return Event[]
     */
    public function getAllEventsByCreatorUlid(string $creator_ulid): array;

    public function deleteByTitleAndCreatorUlid(string $title, string $creator_ulid): bool;
}