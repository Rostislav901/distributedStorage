<?php

namespace App\Storage\Application\DTO;

class RelationDataDTO
{
    public string $title;
    public string $description;
    public string $location;
    public int $startTime;
    public int $endTime;
    public string $fileName;
    public string $fileId;
    public string $filesize;
    public string $user_ulid;

    public function __construct(
        string $title, string $fileId,
        string $description, string $location,
        int $startTime, int $endTime,
        string $fileName, string $user_ulid, string $filesize)
    {
        $this->title = $title;
        $this->description = $description;
        $this->location = $location;
        $this->startTime = $startTime;
        $this->endTime = $endTime;
        $this->fileName = $fileName;
        $this->user_ulid = $user_ulid;
        $this->fileId = $fileId;
        $this->filesize = $filesize;
    }
}
