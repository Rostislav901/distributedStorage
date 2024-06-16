<?php

namespace App\Storage\Domain\Factory;

use App\Storage\Domain\Entity\Event;

class EventEntityFactory
{
    public function create(
        string $title, string $description, string $location,
        int $startTime, int $endTime, string $fileName,
        string $creator_ulid, string $fileId, string $filesize
    ): Event {
        return new Event(
            title: $title,
            description: $description,
            location: $location,
            startTime: $startTime, endTime: $endTime,
            fileName: $fileName,
            filesize: $filesize,
            creator_ulid: $creator_ulid,
            fileId: $fileId
        );
    }
}
