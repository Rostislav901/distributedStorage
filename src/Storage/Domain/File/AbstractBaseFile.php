<?php

namespace App\Data\Domain\File;

abstract class AbstractBaseFile
{
    protected string $fileName;
    protected string $fileContent;
    protected string $mimeType;

    public function __construct(string $fileName, string $fileContent, string $mimeType)
    {
        $this->fileName = $fileName;
        $this->fileContent = $fileContent;
        $this->mimeType = $mimeType;
    }

    abstract function getContent(): string;

    public function getFileName(): string
    {
        return $this->fileName;
    }

    public function getFileContent(): string
    {
        return $this->fileContent;
    }

    public function getMimeType(): string
    {
        return $this->mimeType;
    }

}