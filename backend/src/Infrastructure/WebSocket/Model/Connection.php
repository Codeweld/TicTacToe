<?php

declare(strict_types=1);

namespace App\Infrastructure\WebSocket\Model;

use Ratchet\ConnectionInterface as ExternalConnectionInterface;
use Symfony\Component\Uid\Uuid;

final class Connection implements ConnectionInterface
{
    private string $identifier;

    private int $originalIdentifier;

    public function __construct(
        private ExternalConnectionInterface $externalConnection,
    ) {
        $this->identifier = Uuid::v4()->toRfc4122();
        $this->originalIdentifier = $this->externalConnection->resourceId;
    }

    public function getExternalConnection(): ExternalConnectionInterface
    {
        return $this->externalConnection;
    }

    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    public function getOriginalIdentifier(): int
    {
        return $this->originalIdentifier;
    }
}
