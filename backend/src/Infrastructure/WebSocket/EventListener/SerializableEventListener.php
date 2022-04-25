<?php

declare(strict_types=1);

namespace App\Infrastructure\WebSocket\EventListener;

use App\Application\Event\SerializableEventInterface;
use App\Infrastructure\WebSocket\Handler\RatchetWebSocketHandlerInterface;
use App\Infrastructure\WebSocket\Serializer\EventSerializerInterface;

final class SerializableEventListener
{
    public function __construct(
        private RatchetWebSocketHandlerInterface $webSocketHandler,
        private EventSerializerInterface $eventSerializer,
    ) {
    }

    public function onSerializableEventReceived(
        SerializableEventInterface $serializableEvent,
    ): void {
        $connections = $this->webSocketHandler->getConnectionIterator();

        $externalConnection = $connections
            ->getExternalConnectionByIdentifier(
                $serializableEvent->getConnectionIdentifier(),
            )
        ;

        $serializedEvent = $this->eventSerializer
            ->serializeEventToJSON($serializableEvent)
        ;

        $externalConnection?->send($serializedEvent);
    }
}
