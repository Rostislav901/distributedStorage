<?php

namespace App\Shared\Domain\Mongo;

use MongoDB\Client;

class MongoConnection implements MongoConnectionInterface
{
    private static ?MongoConnection $instance = null;

    private function __construct()
    {
    }

    public static function getInstance(): MongoConnectionInterface
    {
        if (null === self::$instance) {
            self::$instance = new MongoConnection();
        }

        return self::$instance;
    }

    public function getMainMongoClient(): Client
    {
        return new Client($_ENV['MONGODB_URL']);
    }

    public function getMainMongoDB(): string
    {
        return $_ENV['MONGODB_DB'];
    }
}
