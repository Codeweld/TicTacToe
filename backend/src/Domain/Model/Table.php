<?php

declare(strict_types=1);

namespace App\Domain\Model;

use App\Application\Iterator\PlayerIterator;

final class Table implements TableInterface
{
    private PlayerIterator $players;

    private array $fields = [];

    private ?LastMove $lastMove = null;

    public function __construct(
        private int $size,
    ) {
        $this->players = new PlayerIterator();

        $this->resetFields();
    }

    public function resetFields(): void
    {
        for ($y = 0; $y < $this->size; ++$y) {
            for ($x = 0; $x < $this->size; ++$x) {
                $this->fields[$y][$x] = '';
            }
        }
    }

    public function addPlayer(PlayerInterface $player): void
    {
        $this->players->add($player);
    }

    public function getHumanPlayerByConnectionIdentifier(
        string $connectionIdentifier,
    ): ?PlayerInterface {
        return $this->players
            ->getPlayerByConnectionIdentifier($connectionIdentifier)
        ;
    }

    public function getCPUPlayer(): ?PlayerInterface
    {
        $players = $this->getPlayers();

        /** @var PlayerInterface $player */
        foreach ($players as $player) {
            if (!$player instanceof CPUPlayer) {
                continue;
            }

            return $player;
        }

        return null;
    }

    /** @return array|PlayerInterface[] */
    public function getPlayers(): array
    {
        return $this->players->getAll();
    }

    public function getFields(): array
    {
        return $this->fields;
    }

    public function getSize(): int
    {
        return $this->size;
    }

    public function setField(
        int $x,
        int $y,
        string $symbol,
    ): void {
        if (false === isset($this->fields[$y][$x])) {
            throw new \InvalidArgumentException('Move out of range');
        }

        if ('' !== $this->fields[$y][$x]) {
            throw new \InvalidArgumentException('Field already assigned');
        }

        $this->fields[$y][$x] = $symbol;

        $this->lastMove = new LastMove(
            $x,
            $y,
            $symbol,
        );

        $this->resolveResult();
    }

    public function isComplete(): bool
    {
        return 2 === $this->players->count();
    }

    public function resolveResult(): void
    {
        if (true === $this->hasResult()) {
            return;
        }

        $lastMoveX = $this->lastMove->getX();
        $lastMoveY = $this->lastMove->getY();
        $lastMoveSymbol = $this->lastMove->getSymbol();

        $hasTheSameSymbolForXAxis = $this->hasTheSameSymbolForAllInXAxis(
            $lastMoveSymbol,
            $lastMoveX,
        );

        if (true === $hasTheSameSymbolForXAxis) {
            $this->setResultsForPlayers($lastMoveSymbol);

            return;
        }

        $hasTheSameSymbolForYAxis = $this->hasTheSameSymbolForAllInYAxis(
            $lastMoveSymbol,
            $lastMoveY,
        );

        if (true === $hasTheSameSymbolForYAxis) {
            $this->setResultsForPlayers($lastMoveSymbol);

            return;
        }

        $hasTheSameSymbolForFirstDiagonal = $this->hasTheSameSymbolForAllInFirstDiagonal(
            $lastMoveSymbol,
        );

        if (true === $hasTheSameSymbolForFirstDiagonal) {
            $this->setResultsForPlayers($lastMoveSymbol);

            return;
        }

        $hasTheSameSymbolForSecondDiagonal = $this->hasTheSameSymbolForAllInSecondDiagonal(
            $lastMoveSymbol,
        );

        if (true === $hasTheSameSymbolForSecondDiagonal) {
            $this->setResultsForPlayers($lastMoveSymbol);

            return;
        }

        if (
            false === $this->isAnyMovePossible() &&
            false === $this->hasResult()
        ) {
            $this->setDraw();
        }
    }

    public function hasResult(): bool
    {
        $players = $this->getPlayers();

        /** @var PlayerInterface $player */
        foreach ($players as $player) {
            if (null === $player->getResult()) {
                return false;
            }
        }

        return true;
    }

    public function isAnyMovePossible(): bool
    {
        for ($y = 0; $y < $this->size; ++$y) {
            for ($x = 0; $x < $this->size; ++$x) {
                if ('' !== $this->fields[$y][$x]) {
                    continue;
                }

                return true;
            }
        }

        return false;
    }

    public function hasTheSameSymbolForAllInXAxis(
        string $symbol,
        int $x,
    ): bool {
        for ($y = 0; $y < $this->getSize(); ++$y) {
            if ($this->fields[$y][$x] === $symbol) {
                continue;
            }

            return false;
        }

        return true;
    }

    public function hasTheSameSymbolForAllInYAxis(
        string $symbol,
        int $y,
    ): bool {
        for ($x = 0; $x < $this->getSize(); ++$x) {
            if ($this->fields[$y][$x] === $symbol) {
                continue;
            }

            return false;
        }

        return true;
    }

    public function hasTheSameSymbolForAllInFirstDiagonal(
        string $symbol,
    ): bool {
        for ($i = 0; $i < $this->getSize(); ++$i) {
            if ($this->fields[$i][$i] === $symbol) {
                continue;
            }

            return false;
        }

        return true;
    }

    public function hasTheSameSymbolForAllInSecondDiagonal(
        string $symbol,
    ): bool {
        for ($x = 0; $x < $this->getSize(); ++$x) {
            if ($this->fields[$this->getSize() - 1 - $x][$x] === $symbol) {
                continue;
            }

            return false;
        }

        return true;
    }

    private function setDraw(): void
    {
        $players = $this->getPlayers();

        /** @var PlayerInterface $player */
        foreach ($players as $player) {
            $player->assignDraw();
        }
    }

    private function setResultsForPlayers(string $winningSymbol): void
    {
        $players = $this->getPlayers();

        /** @var PlayerInterface $player */
        foreach ($players as $player) {
            if ($player->getSymbol() === $winningSymbol) {
                $player->assignWin();

                continue;
            }

            $player->assignDefeat();
        }
    }
}
