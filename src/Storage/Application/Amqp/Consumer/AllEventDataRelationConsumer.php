<?php

namespace App\Storage\Application\Amqp\Consumer;

use App\Shared\Application\Command\CommandBusInterface;
use App\Storage\Application\DTO\RelationDataDTO;
use App\Storage\Application\UseCase\Command\InsertDataRelationMain\InsertDataRelationCommand;
use OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface;
use PhpAmqpLib\Message\AMQPMessage;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;

class AllEventDataRelationConsumer implements ConsumerInterface
{
    public function __construct(private readonly SerializerInterface $serializer, private readonly CommandBusInterface $commandBus)
    {
    }

    public function execute(AMQPMessage $msg): void
    {
        $data = $this->serializer->deserialize($msg->body, RelationDataDTO::class, JsonEncoder::FORMAT);

        $command = new InsertDataRelationCommand($data);
        $this->commandBus->execute($command);

    }
}
