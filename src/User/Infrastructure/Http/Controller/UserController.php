<?php

namespace App\User\Infrastructure\Http\Controller;

use App\Shared\Application\Attribute\RequestBody;
use App\Shared\Application\Command\CommandBusInterface;
use App\User\Application\DTO\UserRegisterDTO;
use App\User\Application\UseCase\Command\UserRegistration\UserRegistrationCommand;
use Lexik\Bundle\JWTAuthenticationBundle\Response\JWTAuthenticationSuccessResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class UserController extends AbstractController
{
    public function __construct(private readonly CommandBusInterface $commandBus)
    {
    }

    #[Route(path: '/registration', methods: ['POST'])]
    public function registration(
        #[RequestBody] UserRegisterDTO $userRegisterData
    ): Response {
        $command = new UserRegistrationCommand($userRegisterData->name, $userRegisterData->email, $userRegisterData->password);
        /**
         * @var JWTAuthenticationSuccessResponse $result
         */
        $result = $this->commandBus->execute($command);

        return $result;
    }
}
