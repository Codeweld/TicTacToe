<?php

declare(strict_types=1);

namespace spec\App\Application\Factory;

use App\Application\Factory\TableFactoryInterface;
use App\Domain\Model\Table;
use PhpSpec\ObjectBehavior;

final class TableFactorySpec extends ObjectBehavior
{
    function it_implements_interface(): void
    {
        $this->shouldImplement(TableFactoryInterface::class);
    }

    function it_creates_table_with_specified_size(): void
    {
        $table = new Table(3);

        $this
            ->createWithSize(3)
            ->shouldBeLike($table)
        ;
    }
}
