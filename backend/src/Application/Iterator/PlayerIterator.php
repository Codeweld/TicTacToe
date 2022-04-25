<?php

declare(strict_types=1);

namespace App\Application\Iterator;

use App\Domain\Model\PlayerInterface;

final class PlayerIterator implements \Iterator
{
    private array $players = [];

    private int $position = 0;

    private int $playersCount = 0;

    public function current(): PlayerInterface
    {
        return $this->players[$this->position];
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
        return array_key_exists($this->position, $this->players);
    }

    public function rewind(): void
    {
        $this->position = 0;
    }

    public function add(PlayerInterface $player): void
    {
        $this->players = array_merge($this->players, [$player]);

        ++$this->playersCount;
    }

//    public function remove(PlayerInterface $player): void
//    {
//        foreach ($this->players as $key => $element) {
//            if ($element->resourceId === $player->resourceId) {
//                unset($this->players[$key]);
//
//                --$this->playersCount;
//
//                break;
//            }
//        }
//    }
//
    public function getPlayerByConnectionIdentifier(
        string $connectionIdentifier,
    ): ?PlayerInterface {
        /**
         * @var int $key
         * @var PlayerInterface $element
         */
        foreach ($this->players as $key => $element) {
            if ($element->getConnectionIdentifier() === $connectionIdentifier) {
                return $element;
            }
        }

        return null;
    }

    public function count(): int
    {
        return $this->playersCount;
    }

    public function getAll(): array
    {
        return $this->players;
    }
}
