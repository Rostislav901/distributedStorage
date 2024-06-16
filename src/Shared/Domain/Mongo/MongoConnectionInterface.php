<?php

namespace App\Shared\Domain\Mongo;

use MongoDB\Client;

interface MongoConnectionInterface
{
    public function getMainMongoClient(): Client;

    public function getMainMongoDB(): string;
}
