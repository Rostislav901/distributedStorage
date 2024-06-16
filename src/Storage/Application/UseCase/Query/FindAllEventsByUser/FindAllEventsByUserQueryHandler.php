<?php

namespace App\Storage\Application\UseCase\Query\FindAllEventsByUser;

use App\Shared\Application\Query\QueryHandlerInterface;
use App\Shared\Domain\Security\UserFetcherInterface;
use App\Storage\Application\DTO\EventResponseListDTO;
use App\Storage\Application\Transformer\EventDataTransformer;
use App\Storage\Domain\Entity\Event;
use App\Storage\Domain\Repository\EventDataRepositoryInterface;
use Doctrine\Persistence\ManagerRegistry;

class FindAllEventsByUserQueryHandler implements QueryHandlerInterface
{
    public function __construct(
        private readonly ManagerRegistry $managerRegistry,
        private readonly UserFetcherInterface $userFetcher,
        private readonly EventDataTransformer $transformer)
    {
    }

    public function __invoke(FindAllEventsByUserQuery $query): EventResponseListDTO
    {
        /**
         * @var EventDataRepositoryInterface $repository
         */
        $repository = $this->managerRegistry->getRepository(Event::class, 'default');
        $eventsEntityList = $repository->getAllEventsByCreatorUlid($this->userFetcher->getUser()->getUlid());
        $eventsDTOList = $this->transformer->fromEntityListToResponseListDTO($eventsEntityList);

        return new EventResponseListDTO($eventsDTOList);
    }
}
