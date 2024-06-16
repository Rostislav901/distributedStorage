<?php

namespace App\User\Application\Service;

use App\User\Application\DTO\UserRegisterDTO;
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
    )
    {
    }

    public function register(UserRegisterDTO $userRegisterDTO): JWTAuthenticationSuccessResponse
    {
         $user =  $this->factory->create(
             name: $userRegisterDTO->name,
             email: $userRegisterDTO->email,
             password: $userRegisterDTO->password
         );

         $this->userRepository->add($user);

         return  $this->successHandler->handleAuthenticationSuccess($user);
    }
}