<?php

namespace App\Storage\Application\DTO;

class DataResponseListDTO
{
     public string $ulid;
     public string $name;
     public string $password;
     public string $data;

    public function __construct(string $ulid, string $name, string $password, string $data)
    {
        $this->ulid = $ulid;
        $this->name = $name;
        $this->password = $password;
        $this->data = $data;
    }


}