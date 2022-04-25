<?php

declare(strict_types=1);

namespace App\Application\Factory;

use App\Domain\Model\HumanPlayer;
use App\Domain\Model\PlayerInterface;

final class HumanPlayerFactory implements HumanPlayerFactoryInterface
{
    public function createWithSymbolAndConnectionIdentifier(
        string $symbol,
        string $connectionIdentifier,
    ): PlayerInterface {
        return new HumanPlayer(
            $symbol,
            $connectionIdentifier,
        );
    }
}
