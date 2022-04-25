<?php

declare(strict_types=1);

namespace App\Infrastructure\WebSocket\Server;

interface WebSocketServerInterface
{
    public function start(int $port): void;
}
