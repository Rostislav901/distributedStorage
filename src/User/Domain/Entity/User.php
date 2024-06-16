<?php

namespace App\User\Domain\Entity;

use App\Shared\Domain\Service\UlidService;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    private string $ulid;
    private string $name;
    private string $email;
    private string $password;
    /**
     * @var string[]
     */
    private array $roles = ['ROLE_USER'];
    private \DateTimeImmutable $createdAt;

    public function __construct(string $name, string $email)
    {
        $this->ulid = UlidService::ulid();
        $this->email = $email;
        $this->name = $name;
    }

    public function getUlid(): string
    {
        return $this->ulid;
    }

    public function setUlid(string $ulid): void
    {
        $this->ulid = $ulid;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail($email): void
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password, UserPasswordHasherInterface $hasher): void
    {
        $this->password = $hasher->hashPassword($this, $password);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName($name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAtValue(): self
    {
        $this->createdAt = new \DateTimeImmutable();

        return $this;
    }

    public function getUserIdentifier(): string
    {
        return $this->name;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function eraseCredentials()
    {
    }
}
