<?php

namespace App\Storage\Domain\Service;

use App\Shared\Domain\Mongo\MongoConnection;
use App\Shared\Domain\Security\UserFetcherInterface;
use MongoDB\BSON\ObjectId;

class EventFileMaker
{
    public function __construct(private readonly UserFetcherInterface $userFetcher)
    {
    }

    public function makeEventFile(string $eventId, string $filePath, string $fileName): ObjectId
    {
        $file = fopen($filePath, 'r');
        $mongoConnection = MongoConnection::getInstance();

        $mongo = $mongoConnection->getMainMongoClient();
        $db = $mongoConnection->getMainMongoDB();

        $fileStorage = $mongo->selectDatabase($db)->selectGridFSBucket();

        return $fileStorage->uploadFromStream($fileName, $file, [
            'metadata' => [
                'event_id' => $eventId,
                'creator_ulid' => $this->userFetcher->getUser()->getUlid(),
            ],
        ]);
    }
}
