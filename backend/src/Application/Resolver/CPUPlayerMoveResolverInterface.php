<?php

declare(strict_types=1);

namespace App\Application\Resolver;

use App\Application\DTO\CPUMove;
use App\Domain\Model\PlayerInterface;

interface CPUPlayerMoveResolverInterface
{
    public function resolve(PlayerInterface $player): CPUMove;
}
