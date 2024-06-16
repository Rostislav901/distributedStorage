<?php

namespace App\Storage\Domain\Service;

use App\Storage\Domain\Factory\EventDocumentFactory;
use Doctrine\ODM\MongoDB\DocumentManager;

class EventDocumentMaker
{
    public function __construct(
        private readonly EventDocumentFactory $eventDocumentFactory,
        private readonly DocumentManager $documentManager
    ) {
    }

    public function makeEventDocument(
        string $title,
        string $description,
        string $location,
        \DateTime $startTime,
        \DateTime $endTime): string
    {
        $event = $this->eventDocumentFactory->create($title, $description, $location, $startTime, $endTime);

        $this->documentManager->persist($event);
        $this->documentManager->flush();

        return $event->getId();
    }
}
