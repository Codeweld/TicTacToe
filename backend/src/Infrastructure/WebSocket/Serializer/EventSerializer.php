<?php

declare(strict_types=1);

namespace App\Infrastructure\WebSocket\Serializer;

use App\Application\Event\SerializableEventInterface;
use App\Application\Provider\ClassnameProvider;
use App\Application\SerializerInterface;

final class EventSerializer implements EventSerializerInterface
{
    public function __construct(
        private SerializerInterface $serializer,
    ) {
    }

    public function serializeEventToJSON(SerializableEventInterface $serializableEvent): string
    {
        $normalizedData = $this->serializer->normalize($serializableEvent);
        $normalizedData['command'] = ClassnameProvider::provide($serializableEvent);

        if (true === isset($normalizedData['connectionIdentifier'])) {
            unset($normalizedData['connectionIdentifier']);
        }

        return json_encode($normalizedData, JSON_THROW_ON_ERROR);
    }
}
