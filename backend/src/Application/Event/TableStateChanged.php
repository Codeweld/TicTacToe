<?php

declare(strict_types=1);

namespace App\Application\Event;

use App\Domain\Model\PlayerInterface;

final class TableStateChanged implements SerializableEventInterface
{
    public function __construct(
        private array $fields,
        private string $connectionIdentifier,
    ) {
    }

    public static function createForPlayer(PlayerInterface $player): self
    {
        $table = $player->getTable();
        $connectionIdentifier = $player->getConnectionIdentifier();

        return new self(
            $table->getFields(),
            $connectionIdentifier,
        );
    }

    public function getFields(): array
    {
        return $this->fields;
    }

    public function getConnectionIdentifier(): string
    {
        return $this->connectionIdentifier;
    }
}
