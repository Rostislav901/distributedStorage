<?php

namespace App\Storage\Application\UseCase\Command\DeleteEventData;

use App\Shared\Application\Command\CommandHandlerInterface;
use App\Shared\Domain\Mongo\MongoConnection;
use App\Shared\Domain\Security\UserFetcherInterface;
use App\Storage\Domain\Document\Event;
use App\Storage\Domain\Repository\EventDataRepositoryInterface;
use App\Storage\Domain\Repository\EventDataDocumentRepositoryInterface;
use Doctrine\ODM\MongoDB\DocumentManager;
use MongoDB\BSON\ObjectId;

class DeleteEventDataCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private readonly EventDataRepositoryInterface $dataRepository,
        private readonly DocumentManager $documentManager,
        private readonly UserFetcherInterface $userFetcher)
    {
    }

    public function __invoke(DeleteEventDataCommand $command): void
    {
        $eventTitle = $command->eventTitle;
        $user_ulid = $this->userFetcher->getUser()->getUlid();
        $this->dataRepository->deleteByTitleAndCreatorUlid($eventTitle, $user_ulid);

        /**
         * @var EventDataDocumentRepositoryInterface $eventDocumentRepository
         */
        $eventDocumentRepository = $this->documentManager->getRepository(Event::class);
        $eventDocumentRepository->deleteByTitleAndUserUlid($eventTitle, $user_ulid);

        $mongoConnection = MongoConnection::getInstance();
        $mongo = $mongoConnection->getMainMongoClient();
        $db = $mongoConnection->getMainMongoDB();

        $fileStorage = $mongo->selectDatabase($db)->selectGridFSBucket();

        $fileId = new ObjectId($command->fileId);

        $fileStorage->delete($fileId);

        $collection = $mongo->selectCollection($db, 'fs.files');
        $collection->deleteOne(['_id' => $fileId]);
    }
}
