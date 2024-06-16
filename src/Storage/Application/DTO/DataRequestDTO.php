<?php

namespace App\Data\Application\DTO;

use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class DataRequestDTO
{
    #[NotBlank]
    #[Length(min: 3,max: 23)]
     public string $name;
    #[NotBlank]
    #[Length(min: 3,max: 23)]
    public string $password;
    #[NotBlank]
    #[Length(min: 3,max: 23)]
     public string $data;

    public function __construct(string $name, string $password, string $data)
    {
        $this->name = $name;
        $this->password = $password;
        $this->data = $data;
    }


}