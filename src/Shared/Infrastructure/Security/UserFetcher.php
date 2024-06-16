<?php

namespace App\Shared\Infrastructure\Security;

use App\Shared\Domain\Security\UserFetcherInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Security\Core\User\UserInterface;

class UserFetcher implements UserFetcherInterface
{
    public function __construct(private readonly Security $security)
    {
    }

    public function getUser(): UserInterface
    {
        /**
         * @var UserInterface $user
         */
        $user = $this->security->getUser();

        return $user;
    }
}
