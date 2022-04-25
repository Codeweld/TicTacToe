<?php

declare(strict_types=1);

namespace App\Application\Factory;

use App\Domain\Model\PlayerInterface;

interface HumanPlayerFactoryInterface
{
    public function createWithSymbolAndConnectionIdentifier(
        string $symbol,
        string $connectionIdentifier,
    ): PlayerInterface;
}
