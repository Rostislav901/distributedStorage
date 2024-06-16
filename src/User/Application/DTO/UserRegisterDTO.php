<?php

namespace App\User\Application\DTO;

use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class UserRegisterDTO
{
    #[NotBlank]
    #[Email]
    #[Length(max: 255)]
    public string $email;
    #[NotBlank]
    #[Length(min: 5, max: 20)]
    public string $name;
    #[NotBlank]
    #[Length(min: 8, max: 50)]
    public string $password;
}
