<?php

declare(strict_types=1);

namespace App\Domain\Model;

interface TableInterface
{
    public function addPlayer(PlayerInterface $player): void;

    public function getHumanPlayerByConnectionIdentifier(
        string $connectionIdentifier,
    ): ?PlayerInterface;

    public function getCPUPlayer(): ?PlayerInterface;

    public function getPlayers(): array;

    public function getFields(): array;

    public function getSize(): int;

    public function setField(
        int $x,
        int $y,
        string $symbol,
    ): void;

    public function isComplete(): bool;

    public function hasResult(): bool;
}
