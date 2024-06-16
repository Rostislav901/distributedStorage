<?php

namespace App\Storage\Application\Transformer;

use App\Shared\Domain\Security\UserFetcherInterface;
use App\Storage\Application\DTO\DataRequestDTO;
use App\Storage\Application\DTO\EventResponseItemDTO;
use App\Storage\Application\DTO\EventResponseListDTO;
use App\Storage\Application\DTO\FileDataDTO;
use App\Storage\Application\DTO\RelationDataDTO;
use App\Storage\Application\DTO\StorageFileModel;
use App\Storage\Domain\Entity\Data\Event;
use App\Storage\Domain\Entity\DataReserve\DataReserve;
use App\Storage\Domain\File\AbstractBaseFile;

class DataTransformer
{
    public function __construct(private readonly UserFetcherInterface $userFetcher)
    {
    }

    /**
     * @param Event[]|DataReserve[] $entities
     * @return EventResponseItemDTO[]
     */

    public function fromEntityListToDTOList(array $entities): array
    {
        $res = [];
         foreach ($entities as $entity)
         {
            $res[] = $this->formEntityToResponseDTO($entity);
         }

         return $res;
    }


    public function formEntityToResponseDTO(Event|DataReserve $data): EventResponseListDTO
    {
         return new EventResponseListDTO($data->getUlid(),$data->getName(),$data->getPassword(),$data->getUserdata());
    }

    public function fromResponseToRequestDTO(EventResponseListDTO $dataResponseDTO): DataRequestDTO
    {
        return  new DataRequestDTO($dataResponseDTO->name,$dataResponseDTO->password,$dataResponseDTO->data);
    }


    public function fromDataRequestToRelationDTO(DataRequestDTO $dataRequestDTO,AbstractBaseFile $fileDataDTO,string $fileId): RelationDataDTO
    {
        return  new RelationDataDTO(
            title: $dataRequestDTO->title,
            fileId: $fileId,
            description: $dataRequestDTO->description,
            location: $dataRequestDTO->location,
            startTime: $dataRequestDTO->getStartTimeValue()->getTimestamp(),
            endTime: $dataRequestDTO->getEndTimeValue()->getTimestamp(),
            fileName: $fileDataDTO->getFileName(),
            user_ulid: $this->userFetcher->getUser()->getUlid(),
            filesize: $fileDataDTO->getFileSize()
        );
    }

    /**
     * @param Event[] $entityList
     */
    public function fromEntityListToResponseListDTO(array $entityList): array
    {
        $res = [];
        foreach ($entityList as $entity)
        {
              $res[] = $this->fromEntityToResponseDTO($entity);
        }
        return $res;
    }

    public function fromEntityToResponseDTO(Event $event_entity): EventResponseItemDTO
    {
          return  new EventResponseItemDTO(
              title: $event_entity->getTitle(),
              description: $event_entity->getDescription(),
              location: $event_entity->getLocation(),
              startTime: $event_entity->getStartTime(),
              endTime: $event_entity->getEndTime(),
              createdAt: $event_entity->getCreatedAt()->getTimestamp(),
              fileName: $event_entity->getFileName(),
              fileId: $event_entity->getFileId(),
              filesize: $event_entity->getFilesize()
          );
    }
}