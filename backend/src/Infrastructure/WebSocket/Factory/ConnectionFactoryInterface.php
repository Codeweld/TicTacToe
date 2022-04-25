<?php

declare(strict_types=1);

namespace App\Infrastructure\WebSocket\Factory;

use App\Infrastructure\WebSocket\Model\ConnectionInterface;
use Ratchet\ConnectionInterface as ExternalConnectionInterface;

interface ConnectionFactoryInterface
{
    public function createFromExternalConnection(
        ExternalConnectionInterface $externalConnection,
    ): ConnectionInterface;
}
