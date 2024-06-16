<?php

namespace App\User\Application\UseCase\Command\UserRegistration;

use App\Shared\Application\Command\CommandInterface;

class UserRegistrationCommand implements CommandInterface
{
    public function __construct(
        public readonly string $nickname,
        public readonly string $email,
        public readonly string $password)
    {
    }
}
