<?php

declare(strict_types=1);

namespace App\Application\Factory;

use App\Domain\Model\TableInterface;

interface TableFactoryInterface
{
    public function createWithSize(int $size): TableInterface;
}
