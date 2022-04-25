<?php

declare(strict_types=1);

namespace App\Application\Resolver;

use App\Application\DTO\CPUMove;
use App\Domain\Model\PlayerInterface;

final class RandomCPUPlayerMoveResolver implements CPUPlayerMoveResolverInterface
{
    public function resolve(PlayerInterface $player): CPUMove
    {
        $table = $player->getTable();
        $tableSize = $table->getSize();
        $tableFields = $table->getFields();

        $availableMoves = [];

        for ($y = 0; $y < $tableSize; ++$y) {
            for ($x = 0; $x < $tableSize; ++$x) {
                if ('' !== $tableFields[$y][$x]) {
                    continue;
                }

                $availableMoves[] = new CPUMove($x, $y);
            }
        }

        if (0 === count($availableMoves)) {
            throw new \RuntimeException('CPU cannot make any move');
        }

        $randomKey = array_rand($availableMoves);

        return $availableMoves[$randomKey];
    }
}
