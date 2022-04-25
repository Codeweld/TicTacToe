<?php

declare(strict_types=1);

namespace App\Infrastructure\WebSocket\Serializer;

use App\Application\Event\SerializableEventInterface;

interface EventSerializerInterface
{
    public function serializeEventToJSON(SerializableEventInterface $serializableEvent): string;
}
