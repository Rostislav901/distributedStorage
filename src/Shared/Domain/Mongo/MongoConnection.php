<?php

namespace App\Shared\Infrastructure\Mongo;

use App\Shared\Domain\Mongo\MongoConnectionInterface;
use MongoDB\Client;

class MongoConnection implements MongoConnectionInterface
{
    private static ?MongoConnection $instance;
    private function __construct()
    {
    }

    public static function getInstance(): MongoConnectionInterface
    {
         if (self::$instance === null)
         {
             self::$instance = new MongoConnection();
         }

         return self::$instance;
    }
    public function getMainMongoClient(): Client
    {
         return   new Client($_ENV['MONGODB_URL']);
    }

    public function getMainMongoDB(): string
    {
        return  $_ENV['MONGODB_DB'];
    }
}