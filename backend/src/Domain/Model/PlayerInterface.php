<?php

declare(strict_types=1);

namespace App\Domain\Model;

interface PlayerInterface
{
    public const RESULT_WIN = 'win';

    public const RESULT_DEFEAT = 'lose';

    public const RESULT_DRAW = 'draw';

    public function getConnectionIdentifier(): ?string;

    public function getTable(): TableInterface;

    public function setTable(TableInterface $table): void;

    public function getSymbol(): ?string;

    public function setSymbol(?string $symbol): void;

    public function getResult(): ?string;

    public function assignWin(): void;

    public function assignDefeat(): void;

    public function assignDraw(): void;

    public function move(int $x, int $y): void;
}
