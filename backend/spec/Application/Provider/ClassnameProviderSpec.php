<?php

declare(strict_types=1);

namespace spec\App\Application\Provider;

use App\Application\DTO\CPUMove;
use App\Application\Provider\ClassnameProviderInterface;
use PhpSpec\ObjectBehavior;

final class ClassnameProviderSpec extends ObjectBehavior
{
    function it_implements_interface(): void
    {
        $this->shouldImplement(ClassnameProviderInterface::class);
    }

    function it_provides_classname_of_itself(): void
    {
        $this
            ->provide($this)
            ->shouldReturn('ClassnameProvider')
        ;
    }

    function it_provides_classname_of_different_object(): void
    {
        $this
            ->provide(new CPUMove(1, 2))
            ->shouldReturn('CPUMove')
        ;
    }

    function it_provides_classname_from_fully_qualified_classname(): void
    {
        $this
            ->provideFromFQCN(CPUMove::class)
            ->shouldReturn('CPUMove')
        ;
    }
}
