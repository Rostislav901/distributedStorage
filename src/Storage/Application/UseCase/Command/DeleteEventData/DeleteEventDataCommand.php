<?php

namespace App\Storage\Application\UseCase\Command\DeleteEventData;

use App\Shared\Application\Command\CommandInterface;

class DeleteEventDataCommand implements CommandInterface
{
    public function __construct(public string $eventTitle, public string $fileId)
    {
    }
}
