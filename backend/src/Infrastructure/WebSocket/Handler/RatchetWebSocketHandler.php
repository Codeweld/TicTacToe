<?php

declare(strict_types=1);

namespace App\Infrastructure\WebSocket\Handler;

use App\Application\Event\DataReceivedEvent;
use App\Infrastructure\WebSocket\Factory\ConnectionFactoryInterface;
use App\Infrastructure\WebSocket\Iterator\ConnectionIterator;
use Ratchet\ConnectionInterface;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

final class RatchetWebSocketHandler implements RatchetWebSocketHandlerInterface
{
    public function __construct(
        private EventDispatcherInterface $eventDispatcher,
        private ConnectionFactoryInterface $connectionFactory,
        private ConnectionIterator $connectionIterator,
    ) {
        $this->connectionIterator = new ConnectionIterator();
    }

    public function onOpen(ConnectionInterface $connection): void
    {
        $this->connectionIterator->add(
            $this->connectionFactory->createFromExternalConnection($connection)
        );
    }

    public function onMessage(ConnectionInterface $from, $data): void
    {
        $connection = $this->connectionIterator->getByExternalConnection($from);

        if (null === $connection) {
            return;
        }

        $this->eventDispatcher->dispatch(
            new DataReceivedEvent(
                $data,
                $connection->getIdentifier(),
            )
        );
    }

    public function onClose(ConnectionInterface $connection): void
    {
        $this->connectionIterator->removeByExternalConnection($connection);
    }

    public function onError(
        ConnectionInterface $connection,
        \Exception $exception
    ): void {
    }

    public function getConnectionIterator(): ConnectionIterator
    {
        return $this->connectionIterator;
    }
}
