<?php

namespace App\Data\Domain\File;

class TxtFile extends AbstractBaseFile
{

    function getContent(): string
    {
        $file = $this->fileContent;
        $encoding = mb_detect_encoding($file, 'auto');
        return mb_convert_encoding(file_get_contents($file), 'UTF-8', $encoding);
    }
}