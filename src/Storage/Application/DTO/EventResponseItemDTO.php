<?php

namespace App\Storage\Application\DTO;

class EventResponseItemDTO
{
    public string $title;
    public string $description;
    public string $location;
    public int $startTime;
    public int $endTime;
    public int $createdAt;
    public string $fileName;
    public string $fileId;
    public string $fileExt;
    public int $filesize;

    public function __construct(string $title, string $description,
        string $location, int $startTime,
        int $endTime, int $createdAt, string $fileName,
        string $fileId, int $filesize)
    {
        $this->title = $title;
        $this->description = $description;
        $this->location = $location;
        $this->startTime = $startTime;
        $this->endTime = $endTime;
        $this->createdAt = $createdAt;
        $this->fileName = $fileName;
        $this->fileId = $fileId;
        $this->fileExt = $this->getFileExtension($fileName);
        $this->filesize = $filesize;
    }

    public function getFileExtension($filename)
    {
        // Найдем позицию последней точки в строке
        $position = strrpos($filename, '.');

        // Если точка найдена и она не является первым символом
        if (false !== $position && 0 !== $position) {
            return substr($filename, $position + 1);
        }

        return null;
    }
}
