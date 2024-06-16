<?php

namespace App\User\Application\UseCase\Command\UserRegistration;

use App\Shared\Application\Command\CommandHandlerInterface;
use App\User\Domain\Service\RegistrationService;
use Lexik\Bundle\JWTAuthenticationBundle\Response\JWTAuthenticationSuccessResponse;

class UserRegistrationCommandHandler implements CommandHandlerInterface
{
    public function __construct(private readonly RegistrationService $registrationService)
    {
    }

    public function __invoke(UserRegistrationCommand $command): JWTAuthenticationSuccessResponse
    {
        return $this->registrationService->register($command->nickname, $command->email, $command->password);
    }
}
