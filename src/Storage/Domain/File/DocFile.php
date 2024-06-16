<?php

namespace App\Data\Domain\File;

class DocFile extends AbstractBaseFile
{

    function getContent(): string
    {
        return file_get_contents($this->fileContent);
    }
}