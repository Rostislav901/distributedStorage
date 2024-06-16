<?php

namespace App\Storage\Application\UseCase\Command\InsertDataRelationMain;

use App\Shared\Application\Command\CommandHandlerInterface;
use App\Storage\Domain\Service\EventEntityMaker;

class InsertDataRelationCommandHandler implements CommandHandlerInterface
{
    public function __construct(private readonly EventEntityMaker $entityMaker)
    {
    }

    public function __invoke(InsertDataRelationCommand $command): void
    {
        $data = $command->relationDataDTO;

        $this->entityMaker->makeEventEntity(
            title: $data->title,
            description: $data->description,
            location: $data->location,
            startTime: $data->startTime,
            endTime: $data->endTime,
            fileName: $data->fileName,
            creator_ulid: $data->user_ulid,
            fileId: $data->fileId,
            filesize: $data->filesize
        );
    }
}
