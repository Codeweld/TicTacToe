<?php

declare(strict_types=1);

namespace App\Application\Factory;

use App\Domain\Model\Table;
use App\Domain\Model\TableInterface;

final class TableFactory implements TableFactoryInterface
{
    public function createWithSize(int $size): TableInterface
    {
        return new Table($size);
    }
}
