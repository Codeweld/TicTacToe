<?php

declare(strict_types=1);

namespace App\Application\Factory;

use App\Domain\Model\PlayerInterface;

interface CPUPlayerFactoryInterface
{
    public function create(): PlayerInterface;
}
