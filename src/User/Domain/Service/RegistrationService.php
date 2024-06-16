<?php

namespace App\User\Domain\Service;

use App\User\Domain\Factory\UserFactory;
use App\User\Domain\Repository\UserRepositoryInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Response\JWTAuthenticationSuccessResponse;
use Lexik\Bundle\JWTAuthenticationBundle\Security\Http\Authentication\AuthenticationSuccessHandler;

class RegistrationService
{
    public function __construct(
        private readonly AuthenticationSuccessHandler $successHandler,
        private readonly UserFactory $factory,
        private readonly UserRepositoryInterface $userRepository
    ) {
    }

    public function register(string $name, string $email, string $password): JWTAuthenticationSuccessResponse
    {
        $user = $this->factory->create(
            name: $name,
            email: $email,
            password: $password
        );

        $this->userRepository->add($user);

        return $this->successHandler->handleAuthenticationSuccess($user);
    }
}
