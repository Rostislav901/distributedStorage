<?php

namespace App\Storage\Domain\Mongo;

use MongoDB\Client;

interface MongoConnectionInterface
{

    public function getMainMongoClient(): Client;
}