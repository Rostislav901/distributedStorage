<?php

namespace App\Storage\Domain\Repository;

interface EventDataDocumentRepositoryInterface
{
    public function deleteByTitleAndUserUlid(string $title, string $userUlid): void;
}
