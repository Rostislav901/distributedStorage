<?php

namespace App\Storage\Infrastructure\Http\Controller;

use App\Shared\Application\Attribute\RequestBody;
use App\Shared\Application\Attribute\RequestFile;
use App\Shared\Application\Command\CommandBusInterface;
use App\Shared\Application\Query\QueryBusInterface;
use App\Storage\Application\DTO\DataRequestDTO;
use App\Storage\Application\DTO\EventResponseListDTO;
use App\Storage\Application\DTO\StorageFileModel;
use App\Storage\Application\UseCase\Command\DeleteEventData\DeleteEventDataCommand;
use App\Storage\Application\UseCase\Command\InsertDataMongoMain\InsertDataCommand;
use App\Storage\Application\UseCase\Query\FindAllEventsByUser\FindAllEventsByUserQuery;
use App\Storage\Application\UseCase\Query\FIndFileById\FindFileByIdQuery;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\Routing\Attribute\Route;

class DataController extends AbstractController
{
    public function __construct(
        private readonly CommandBusInterface $commandBus,
        private readonly QueryBusInterface $queryBus,
    ) {
    }

    #[Route(path: '/main-server/v1/data/all', methods: ['POST'])]
    public function dataInStorage(
        #[RequestBody] DataRequestDTO $eventData,
        #[RequestFile] StorageFileModel $fileModel
    ): Response {
        $command = new InsertDataCommand(
            dataRequestDTO: $eventData,
            file: $fileModel->getModelFile()
        );

        $this->commandBus->execute($command);

        return $this->json('success');
    }

    #[Route(path: '/main-server/v1/data/all/get/by/user', methods: ['GET'])]
    public function getAllDataByUser(): Response
    {
        $query = new FindAllEventsByUserQuery();

        /**
         * @var EventResponseListDTO $result
         */
        $result = $this->queryBus->execute($query);

        return $this->json($result);
    }

    #[Route(path: '/main-server/v1/data/download/{fileId}', methods: ['GET'])]
    public function downloadFileByFilename(string $fileId): Response
    {
        $downloadFileQuery = new FindFileByIdQuery($fileId);
        /**
         * @var StreamedResponse $response
         */
        $response = $this->queryBus->execute($downloadFileQuery);

        return $response;
    }

    #[Route(path: '/main-server/v1/data/delete/{eventTitle}/{fileId}', methods: ['DELETE'])]
    public function deleteEventById(string $eventTitle, string $fileId): Response
    {
        $command = new DeleteEventDataCommand($eventTitle, $fileId);

        $this->commandBus->execute($command);

        return $this->json('success');
    }
}
