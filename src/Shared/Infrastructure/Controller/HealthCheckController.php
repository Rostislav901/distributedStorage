<?php

namespace App\Shared\Infrastructure\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Attribute\Route;

#[AsController]
class HealthCheckController
{
    #[Route('/health/check', methods: ['POST'])]
    public function __invoke(): Response
    {
        return new JsonResponse('success');
    }
}
