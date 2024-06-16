<?php

namespace App\Storage\Application\UseCase\InsertDataRelationMain;

use App\Shared\Application\Command\CommandInterface;
use App\Storage\Application\DTO\RelationDataDTO;

class InsertDataRelationCommand implements CommandInterface
{
    public function __construct(public readonly RelationDataDTO $relationDataDTO)
    {
    }
}