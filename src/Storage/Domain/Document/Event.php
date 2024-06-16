<?php

namespace App\Storage\Domain\Document\Data;
use App\Storage\Infrastructure\Repository\DataDocumentRepository;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
#[ODM\Document(db: 'data', collection: 'main_events', repositoryClass: DataDocumentRepository::class)]
#[ODM\HasLifecycleCallbacks]
class Event
{
    #[ODM\Id]
    private string $id;
    #[ODM\Field( type: 'string')]
    private string $title;

    #[ODM\Field( type: 'string')]
    private string $description;

    #[ODM\Field( type: 'string')]
    private string $location;
    #[ODM\Field( type: 'date')]
    private \DateTime $startTime;
    #[ODM\Field( type: 'date')]
    private \DateTime $endTime;
    #[Odm\Field( type: 'string')]
    private string $user_ulid;
    #[ODM\Field( type: 'date')]
    private \DateTime $createdAt;
    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): self
    {
        $this->id = $id;
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

    public function getStartTime(): \DateTime
    {
        return $this->startTime;
    }

    public function setStartTime(\DateTime $startTime): self
    {
        $this->startTime = $startTime;
        return $this;
    }

    public function getEndTime(): \DateTime
    {
        return $this->endTime;
    }

    public function setEndTime(\DateTime $endTime): self
    {
        $this->endTime = $endTime;
        return $this;
    }

    public function getUserUlid(): string
    {
        return $this->user_ulid;
    }

    public function setUserUlid(string $user_ulid): self
    {
        $this->user_ulid = $user_ulid;
        return $this;
    }


    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }
    #[ODM\PrePersist]
    public function setCreatedAtValue(): void
    {
        $this->createdAt = new \DateTime();
    }
}