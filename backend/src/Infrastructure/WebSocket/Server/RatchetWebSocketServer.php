<?php

declare(strict_types=1);

namespace App\Infrastructure\WebSocket\Server;

use App\Infrastructure\WebSocket\Handler\RatchetWebSocketHandlerInterface;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;

final class RatchetWebSocketServer implements WebSocketServerInterface
{
    public function __construct(
        private RatchetWebSocketHandlerInterface $ratchetWebSocketHandler,
    ) {
    }

    public function start(int $port): void
    {
        $server = IoServer::factory(
            new HttpServer(
                new WsServer(
                    $this->ratchetWebSocketHandler,
                ),
            ),
            $port,
        );

        $server->run();
    }
}
