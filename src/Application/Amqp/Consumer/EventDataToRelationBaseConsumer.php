<?php

namespace App\Application\Amqp\Consumer;

use App\Application\DTO\EventDataDTO;
use App\Domain\Entity\Event;
use Doctrine\ORM\EntityManagerInterface;
use OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface;
use PhpAmqpLib\Message\AMQPMessage;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;

class EventDataToRelationBaseConsumer implements ConsumerInterface
{
    public function __construct(private readonly SerializerInterface $serializer, private readonly EntityManagerInterface $entityManager)
    {
    }

    public function execute(AMQPMessage $msg)
    {
        $eventDto = $this->serializer->deserialize($msg->body, EventDataDTO::class, JsonEncoder::FORMAT);

        $eventEntity = new Event(
            title: $eventDto->title,
            description: $eventDto->description,
            location: $eventDto->location,
            startTime: $eventDto->startTime,
            endTime: $eventDto->endTime,
            fileName: $eventDto->fileName,
            filesize: $eventDto->filesize,
            creator_ulid: $eventDto->user_ulid,
            fileId: $eventDto->fileId
        );

        $this->entityManager->persist($eventEntity);
        $this->entityManager->flush();
    }
}
