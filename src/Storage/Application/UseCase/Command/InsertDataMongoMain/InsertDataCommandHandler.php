<?php

namespace App\Storage\Application\UseCase\Command\InsertDataMongoMain;

use App\Shared\Application\Command\CommandHandlerInterface;
use App\Storage\Application\Amqp\Publisher\EventDataPublisher;
use App\Storage\Application\Transformer\EventDataTransformer;
use App\Storage\Domain\Service\EventDocumentMaker;
use App\Storage\Domain\Service\EventFileMaker;

class InsertDataCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private readonly EventDocumentMaker $documentMaker,
        private readonly EventDataTransformer $dataTransformer,
        private readonly EventFileMaker $eventFileMaker,
        private readonly EventDataPublisher $eventDataPublisher,
    ) {
    }

    public function __invoke(InsertDataCommand $insertDataCommand): void
    {
        $eventData = $insertDataCommand->dataRequestDTO;
        $fileData = $insertDataCommand->file;

        $eventId = $this->documentMaker->makeEventDocument(
            title: $eventData->title,
            description: $eventData->description,
            location: $eventData->location,
            startTime: $eventData->getStartTimeValue(),
            endTime: $eventData->getEndTimeValue(),
        );

        $fileId = $this->eventFileMaker->makeEventFile($eventId, $fileData->getFilePath(), $fileData->getFileName());

        $this->eventDataPublisher->forRelationReplication(
            $this->dataTransformer->fromDataRequestToRelationDTO(
                $eventData, $insertDataCommand->file, $fileId
            ));
    }
}
