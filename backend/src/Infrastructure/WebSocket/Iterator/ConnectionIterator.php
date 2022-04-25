<?php

declare(strict_types=1);

namespace App\Infrastructure\WebSocket\Iterator;

use App\Infrastructure\WebSocket\Model\Connection;
use App\Infrastructure\WebSocket\Model\ConnectionInterface;
use Ratchet\ConnectionInterface as ExternalConnectionInterface;

final class ConnectionIterator implements \Iterator
{
    /** @var array|Connection[] */
    private array $connections = [];

    private int $position = 0;

    private int $connectionsCount = 0;

    public function current(): ConnectionInterface
    {
        return $this->connections[$this->position];
    }

    public function next(): void
    {
        ++$this->position;
    }

    public function key(): int
    {
        return $this->position;
    }

    public function valid(): bool
    {
        return array_key_exists($this->position, $this->connections);
    }

    public function rewind(): void
    {
        $this->position = 0;
    }

    public function add(ConnectionInterface $connection): void
    {
        $this->connections = array_merge($this->connections, [$connection]);

        ++$this->connectionsCount;
    }

    public function remove(ConnectionInterface $connection): void
    {
        foreach ($this->connections as $key => $element) {
            if ($element->getIdentifier() === $connection->getIdentifier()) {
                unset($this->connections[$key]);

                --$this->connectionsCount;

                break;
            }
        }
    }

    public function removeByExternalConnection(ExternalConnectionInterface $externalConnection): void
    {
        foreach ($this->connections as $key => $connection) {
            if ($connection->getOriginalIdentifier() === $externalConnection->resourceId) {
                unset($this->connections[$key]);

                --$this->connectionsCount;

                break;
            }
        }
    }

    public function getByExternalConnection(ExternalConnectionInterface $externalConnection): ?ConnectionInterface
    {
        foreach ($this->connections as $connection) {
            if ($connection->getOriginalIdentifier() === $externalConnection->resourceId) {
                return $connection;
            }
        }

        return null;
    }

    public function getByIdentifier(string $identifier): ?ConnectionInterface
    {
        foreach ($this->connections as $element) {
            if ($element->getIdentifier() === $identifier) {
                return $element;
            }
        }

        return null;
    }

    public function getExternalConnectionByIdentifier(
        string $identifier,
    ): ?ExternalConnectionInterface {
        $connection = $this->getByIdentifier($identifier);

        return $connection?->getExternalConnection();

    }

    public function count(): int
    {
        return $this->connectionsCount;
    }
}
