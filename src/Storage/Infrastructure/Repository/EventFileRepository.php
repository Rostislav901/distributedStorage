<?php

namespace App\Storage\Infrastructure\Repository;

use App\Shared\Domain\Mongo\MongoConnection;
use App\Storage\Domain\Repository\EventFileRepositoryInterface;
use MongoDB\BSON\ObjectId;
use MongoDB\Client;
use MongoDB\GridFS\Bucket;

class EventFileRepository implements EventFileRepositoryInterface
{
    public Client $mongoClient;
    public string $mongoDB;
    public Bucket $fileStorage;

    public function __construct()
    {
        $connection = MongoConnection::getInstance();

        $this->mongoClient = $connection->getMainMongoClient();
        $this->mongoDB = $connection->getMainMongoDB();
        $this->fileStorage = new Bucket($this->mongoClient->getManager(), $this->mongoDB);
    }

    public function findFileByIdAndCreatorUlid(ObjectId $fileId, string $creator_ulid): mixed
    {
        return $this->fileStorage->find(['_id' => $fileId, 'metadata.creator_ulid' => $creator_ulid])->toArray()[0];
    }

    /**
     * @return resource
     */
    public function getDownloadFileStream(ObjectId $fileId): mixed
    {
        return $this->fileStorage->openDownloadStream($fileId);
    }
}
