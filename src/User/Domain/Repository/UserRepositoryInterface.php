<?php

namespace App\User\Domain\Repository;

use App\User\Domain\Entity\User;

interface UserRepositoryInterface
{
    public function add(User $user): void;
}
