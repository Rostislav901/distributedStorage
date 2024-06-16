<?php

namespace App\Storage\Domain\Repository;

interface DataDocumentRepositoryInterface
{
    public function deleteByTitleAndUserUlid(string $title, string $userUlid): void;
}