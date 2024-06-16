<?php

namespace App\Infrastructure\Security;
use App\Domain\Entity\User;
use Symfony\Bundle\SecurityBundle\Security;
class UserFetcher
{
    public function __construct(private readonly Security $security)
    {
    }

    public function getUserAuth(): User
    {
        /**
         * @var User $user
         */
        $user = $this->security->getUser();


        return $user;
    }
}