<?php

declare(strict_types=1);

namespace App\Infrastructure\WebSocket\Handler;

use App\Infrastructure\WebSocket\Iterator\ConnectionIterator;
use Ratchet\MessageComponentInterface;

interface RatchetWebSocketHandlerInterface extends MessageComponentInterface
{
    public function getConnectionIterator(): ConnectionIterator;
}
