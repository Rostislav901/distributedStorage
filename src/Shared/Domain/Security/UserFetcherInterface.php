<?php

namespace App\Shared\Domain\Security;

use Symfony\Component\Security\Core\User\UserInterface;

interface UserFetcherInterface
{
    public function getUser(): UserInterface;
}
