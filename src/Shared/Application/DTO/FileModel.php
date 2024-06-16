<?php

namespace App\Shared\Application\DTO;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileModel
{
    public function __construct(public UploadedFile $file)
    {
    }

    public function getFile(): UploadedFile
    {
        return $this->file;
    }
}
