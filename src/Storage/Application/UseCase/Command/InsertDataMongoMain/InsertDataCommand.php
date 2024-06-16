<?php

namespace App\Storage\Application\UseCase\Command\InsertDataMongoMain;

use App\Shared\Application\Command\CommandInterface;
use App\Storage\Application\DTO\DataRequestDTO;
use App\Storage\Domain\File\AbstractBaseFile;

class InsertDataCommand implements CommandInterface
{
    public function __construct(
        public readonly DataRequestDTO $dataRequestDTO,
        public readonly AbstractBaseFile $file
    ) {
    }
}
