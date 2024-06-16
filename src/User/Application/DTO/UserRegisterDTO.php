<?php

namespace App\Application\DTO;

use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class UserRegisterDTO
{
    #[NotBlank]
    #[Email]
    public string $email;
    #[NotBlank]
    #[Length(min: 3,max: 23)]
    public string $name;
    #[NotBlank]
    #[Length(min: 3,max: 23)]
    public string $password;
}