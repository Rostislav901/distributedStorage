<?php

namespace App\Storage\Application\DTO;

class EventResponseListDTO
{
    /**
     * @var EventResponseItemDTO[]
     */
    private array $events;

    /**
     * @param EventResponseItemDTO[] $events
     */
    public function __construct(array $events)
    {
        $this->events = $events;
    }

    /**
     * @return EventResponseItemDTO[]
     */
    public function getEvents(): array
    {
        return $this->events;
    }

    /**
     * @param EventResponseItemDTO[] $events
     */
    public function setEvents(array $events): self
    {
        $this->events = $events;

        return $this;
    }
}
