<?php

namespace App\Data\Domain\File;

class ExtNotFoundFile extends AbstractBaseFile
{

    function getContent(): string
    {
        return 'not found';
    }
}