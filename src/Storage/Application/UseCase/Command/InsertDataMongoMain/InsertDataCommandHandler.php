<?php

namespace App\Storage\Application\UseCase\InsertDataMongoMain;

use App\Shared\Application\Command\CommandHandlerInterface;
use App\Storage\Application\Amqp\Publisher\PublishService;
use App\Storage\Application\Transformer\DataTransformer;
use App\Storage\Domain\Service\EventDocumentMaker;
use App\Storage\Domain\Service\EventFileMaker;

class InsertDataCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private readonly EventDocumentMaker $documentMaker,
        private readonly DataTransformer $dataTransformer,
        private readonly EventFileMaker $eventFileMaker,
        private readonly PublishService $publishService,
    )
    {
    }


    public function __invoke(InsertDataCommand $insertDataCommand) : void
    {
        $eventData = $insertDataCommand->dataRequestDTO;
        $eventId =  $this->documentMaker->makeEventDocument(
            title: $eventData->title,
            description: $eventData->description,
            location: $eventData->location,
            startTime: $eventData->getStartTimeValue(),
            endTime: $eventData->getEndTimeValue(),
        );
        $this->eventFileMaker->makeEventFile($eventId,$insertDataCommand->file->getFilePath(),$insertDataCommand->file->getFileName());

        $this->publishService->forRelationReplication(
            $this->dataTransformer->fromDataRequestToRelationDTO(
                $eventData, $insertDataCommand->file
            ));

    }
}