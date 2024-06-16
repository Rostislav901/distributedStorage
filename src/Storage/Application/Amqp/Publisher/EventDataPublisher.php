<?php

namespace App\Storage\Application\Amqp\Publisher;

use App\Storage\Application\DTO\DocumentOrientedDataDTO;
use App\Storage\Application\DTO\RelationDataDTO;
use OldSound\RabbitMqBundle\RabbitMq\ProducerInterface;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Serializer\SerializerInterface;

class EventDataPublisher
{
    private readonly ProducerInterface $producer;

    public function __construct(private readonly KernelInterface $kernel, private readonly SerializerInterface $serializer)
    {
    }

    public function forRelationReplication(RelationDataDTO $relationDataDTO): void
    {
        $publishData = $this->serializer->serialize($relationDataDTO, 'json');
        $this->producer = $this->kernel->getContainer()->get('old_sound_rabbit_mq.send_all_eventData_relation_producer');
        $this->producer->publish($publishData);
    }

    public function forDocumentOrientedReplication(DocumentOrientedDataDTO $dataDTO): void
    {
        $publishData = $this->serializer->serialize($dataDTO, 'json');
        $this->producer = $this->kernel->getContainer()->get('old_sound_rabbit_mq.send_all_eventData_doc_producer');
        $this->producer->publish($publishData);
    }
}
