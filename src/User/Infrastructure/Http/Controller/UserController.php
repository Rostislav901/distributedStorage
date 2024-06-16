<?php

namespace App\Infrastructure\Controller;

use App\Shared\Application\Attribute\RequestBody;
use App\User\Application\DTO\UserRegisterDTO;
use App\User\Application\Service\RegistrationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class UserController extends AbstractController
{
    public function __construct(private readonly RegistrationService $registrationService)
    {
    }

    #[Route(path: '/registration',methods: ['POST'])]
    public function registration(#[RequestBody]UserRegisterDTO $userRegisterDTO): Response
    {
        return $this->registrationService->register($userRegisterDTO);
    }
}