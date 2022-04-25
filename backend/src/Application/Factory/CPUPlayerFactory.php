<?php

declare(strict_types=1);

namespace App\Application\Factory;

use App\Domain\Model\CPUPlayer;
use App\Domain\Model\PlayerInterface;

final class CPUPlayerFactory implements CPUPlayerFactoryInterface
{
    public function create(): PlayerInterface
    {
        return new CPUPlayer();
    }
}
