<?php

namespace App\Storage\Application\UseCase\Query\FIndFileById;

use App\Shared\Application\Query\QueryInterface;

class FindFileByIdQuery implements QueryInterface
{
    public function __construct(public string $fileId)
    {
    }
}
