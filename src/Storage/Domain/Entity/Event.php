<?php

namespace App\Storage\Domain\Entity;

use App\Shared\Domain\Service\UlidService;
use App\Storage\Domain\Repository\EventFileRepositoryInterface;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EventFileRepositoryInterface::class)]
#[ORM\Table(name: 'main_events')]
#[ORM\HasLifecycleCallbacks]
class Event
{
    #[ORM\Id()]
    #[ORM\Column(type: 'string', length: 26)]
    private string $ulid;
    #[ORM\Id()]
    #[ORM\Column(type: 'string', length: 64)]
    private string $title;
    #[ORM\Column(type: 'string', length: 64)]
    private string $description;
    #[ORM\Column(type: 'string', length: 64)]
    private string $location;
    #[ORM\Column(type: 'string', length: 26)]
    private string $creator_ulid;
    #[ORM\Column(type: 'integer')]
    private int $startTime;
    #[ORM\Column(type: 'integer')]
    private int $endTime;

    #[ORM\Column(type: 'string', length: 64)]
    private string $fileName;
    #[ORM\Column(type: 'string', length: 128)]
    private string $fileId;
    #[ORM\Column(type: 'integer')]
    private int $filesize;
    #[ORM\Column(type: 'datetime_immutable')]
    private \DateTimeImmutable $createdAt;

    public function __construct(string $title, string $description, string $location,
        int $startTime, int $endTime, string $fileName, int $filesize,
        string $creator_ulid, string $fileId)
    {
        $this->ulid = UlidService::ulid();
        $this->title = $title;
        $this->description = $description;
        $this->location = $location;
        $this->startTime = $startTime;
        $this->endTime = $endTime;
        $this->fileName = $fileName;
        $this->creator_ulid = $creator_ulid;
        $this->fileId = $fileId;
        $this->filesize = $filesize;
    }

    public function getUlid(): string
    {
        return $this->ulid;
    }

    public function setUlid(string $ulid): self
    {
        $this->ulid = $ulid;

        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getLocation(): string
    {
        return $this->location;
    }

    public function setLocation(string $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getStartTime(): int
    {
        return $this->startTime;
    }

    public function setStartTime(int $startTime): self
    {
        $this->startTime = $startTime;

        return $this;
    }

    public function getEndTime(): int
    {
        return $this->endTime;
    }

    public function setEndTime(int $endTime): self
    {
        $this->endTime = $endTime;

        return $this;
    }

    public function getFileName(): string
    {
        return $this->fileName;
    }

    public function setFileName(string $fileName): self
    {
        $this->fileName = $fileName;

        return $this;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getCreatorUlid(): string
    {
        return $this->creator_ulid;
    }

    public function setCreatorUlid(string $creator_ulid): self
    {
        $this->creator_ulid = $creator_ulid;

        return $this;
    }

    public function getFileId(): string
    {
        return $this->fileId;
    }

    public function setFileId(string $fileId): self
    {
        $this->fileId = $fileId;

        return $this;
    }

    public function getFilesize(): int
    {
        return $this->filesize;
    }

    public function setFilesize(int $filesize): self
    {
        $this->filesize = $filesize;

        return $this;
    }

    #[ORM\PrePersist]
    public function setCreatedAtValue(): void
    {
        $this->createdAt = new \DateTimeImmutable();
    }
}
