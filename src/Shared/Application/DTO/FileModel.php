<?php

namespace App\Shared\Application\DTO;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileDTO
{
    public function __construct(public UploadedFile $file)
    {
    }

    public function getFile(): UploadedFile
    {
        return $this->file;
    }
}