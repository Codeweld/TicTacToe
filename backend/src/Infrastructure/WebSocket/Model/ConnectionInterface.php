<?php

declare(strict_types=1);

namespace App\Infrastructure\WebSocket\Model;

use Ratchet\ConnectionInterface as ExternalConnectionInterface;

interface ConnectionInterface
{
    public function getExternalConnection(): ExternalConnectionInterface;

    public function getIdentifier(): string;
}
