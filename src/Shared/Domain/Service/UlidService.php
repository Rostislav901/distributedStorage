<?php

namespace App\Domain\Service;

use Symfony\Component\Uid\Ulid;

class UlidService
{
    public static function ulid(): string
    {
        return  Ulid::generate();
    }
}