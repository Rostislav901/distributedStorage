<?php

namespace App\Storage\Domain\Repository;

use MongoDB\BSON\ObjectId;

interface EventFileRepositoryInterface
{
    public function findFileByIdAndCreatorUlid(ObjectId $fileId, string $creator_ulid): mixed;

    /**
     * @return resource
     */
    public function getDownloadFileStream(ObjectId $fileId): mixed;
}
