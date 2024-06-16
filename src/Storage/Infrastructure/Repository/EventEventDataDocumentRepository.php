<?php

namespace App\Storage\Infrastructure\Repository;

use App\Storage\Domain\Document\Event;
use App\Storage\Domain\Repository\DataDocumentRepositoryInterface;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use Doctrine\ODM\MongoDB\Repository\DocumentRepository;
use Doctrine\ODM\MongoDB\UnitOfWork;

class EventDataDocumentRepository extends DocumentRepository implements DataDocumentRepositoryInterface
{
    public function __construct(DocumentManager $dm, UnitOfWork $uow)
    {
        parent::__construct($dm, $uow, new ClassMetadata(Event::class));
    }

    public function deleteByTitleAndUserUlid(string $title, string $userUlid): void
    {
         $event = $this->findOneBy(['title' => $title, 'user_ulid' => $userUlid]);
         if ($event) {
             $this->dm->remove($event);
             $this->dm->flush();
         }
    }
}