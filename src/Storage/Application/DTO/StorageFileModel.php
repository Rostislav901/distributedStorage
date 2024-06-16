<?php

namespace App\Storage\Application\DTO;

use App\Shared\Application\DTO\FileDTO;
use App\Storage\Domain\File\AbstractBaseFile;
use App\Storage\Domain\File\AudioACCFile;
use App\Storage\Domain\File\AudioMP3File;
use App\Storage\Domain\File\AudioOGGFile;
use App\Storage\Domain\File\AudioWAVFile;
use App\Storage\Domain\File\DocFile;
use App\Storage\Domain\File\ExtNotFoundFile;
use App\Storage\Domain\File\JpegFile;
use App\Storage\Domain\File\PdfFile;
use App\Storage\Domain\File\PngFile;
use App\Storage\Domain\File\TxtFile;
use App\Storage\Domain\File\VideoAVIFile;
use App\Storage\Domain\File\VideoMKVFile;
use App\Storage\Domain\File\VideoMOVFile;
use App\Storage\Domain\File\VideoMP4File;

class StorageFileDTO extends FileDTO
{
    public function getModelFile(): AbstractBaseFile
    {
         $fileName = $this->file->getClientOriginalName();
         $fileContent = $this->file->getPathname();
         $fileMimeType = $this->file->getMimeType();
         $fileSize = $this->file->getSize();

        return match ($fileMimeType) {
            'image/jpeg' => new JpegFile($fileName, $fileContent, $fileMimeType,$fileSize),
            'image/png' => new PngFile($fileName, $fileContent, $fileMimeType,$fileSize),
            'application/pdf' => new PdfFile($fileName, $fileContent, $fileMimeType,$fileSize),
            'text/plain' => new TxtFile($fileName, $fileContent, $fileMimeType,$fileSize),
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/msword' => new DocFile($fileName, $fileContent, $fileMimeType,$fileSize),
            'video/mp4' => new VideoMP4File($fileName, $fileContent, $fileMimeType,$fileSize),
            'video/quicktime' => new VideoMOVFile($fileName, $fileContent, $fileMimeType,$fileSize),
            'video/x-msvideo' => new VideoAVIFile($fileName, $fileContent, $fileMimeType,$fileSize),
            'video/x-matroska' => new VideoMKVFile($fileName, $fileContent, $fileMimeType,$fileSize),
            'audio/wav' => new AudioWAVFile($fileName,$fileContent,$fileMimeType,$fileSize),
            'audio/ogg' => new AudioOGGFile($fileName,$fileContent,$fileMimeType,$fileSize),
            'audio/aac' => new AudioACCFile($fileName,$fileContent,$fileMimeType,$fileSize),
            default => new ExtNotFoundFile($fileName, $fileContent, $fileMimeType,$fileSize)
        };
    }
}