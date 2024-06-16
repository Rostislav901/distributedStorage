<?php

namespace App\Storage\Domain\File;

class ExtNotFoundFile extends AbstractBaseFile
{
    public function getContent(): string
    {
        return 'not found';
    }
}
