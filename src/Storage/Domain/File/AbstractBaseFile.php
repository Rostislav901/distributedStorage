<?php

namespace App\Storage\Domain\File;

abstract class AbstractBaseFile
{
    protected string $fileName;
    protected string $filePath;
    protected string $mimeType;
    protected string $fileSize;

    public function __construct(string $fileName, string $filePath, string $mimeType, string $fileSize)
    {
        $this->fileName = $fileName;
        $this->filePath = $filePath;
        $this->mimeType = $mimeType;
        $this->fileSize = $fileSize;
    }

    abstract public function getContent(): string;

    public function getFileName(): string
    {
        return $this->fileName;
    }

    public function getFilePath(): string
    {
        return $this->filePath;
    }

    public function getMimeType(): string
    {
        return $this->mimeType;
    }

    public function getFileSize(): string
    {
        return $this->fileSize;
    }
}
