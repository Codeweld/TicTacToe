<?php

declare(strict_types=1);

namespace App\Application\Event;

use App\Domain\Model\PlayerInterface;

final class GameEnded implements SerializableEventInterface
{
    public function __construct(
        private ?string $playerResult,
        private string $connectionIdentifier,
    ) {
    }

    public static function createForPlayer(PlayerInterface $player): self
    {
        return new self(
            $player->getResult(),
            $player->getConnectionIdentifier(),
        );
    }

    public function getPlayerResult(): ?string
    {
        return $this->playerResult;
    }

    public function getConnectionIdentifier(): string
    {
        return $this->connectionIdentifier;
    }
}
