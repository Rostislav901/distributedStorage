<?php

namespace App\Infrastructure\Repository;

use App\User\Domain\Entity\User;
use App\User\Domain\Repository\UserRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;


class UserRepository extends ServiceEntityRepository implements UserRepositoryInterface
{
    private readonly EntityManagerInterface $entityManager;
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);

        $this->entityManager = $this->getEntityManager();
    }

    public function add(User $user): void
    {
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }
}