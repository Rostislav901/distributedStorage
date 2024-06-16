<?php

namespace App\Domain\Factory;

use App\Domain\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFactory
{
    public function __construct(private readonly UserPasswordHasherInterface $hasher)
    {
    }

    public function create(
        string $name,string $email, string $password
    ): User
    {
        $user =   new User($name,$email);

        $user->setPassword($password,$this->hasher);

        return $user;
    }
}