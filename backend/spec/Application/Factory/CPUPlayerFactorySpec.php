<?php

declare(strict_types=1);

namespace spec\App\Application\Factory;

use App\Application\Factory\CPUPlayerFactoryInterface;
use App\Domain\Model\CPUPlayer;
use PhpSpec\ObjectBehavior;

final class CPUPlayerFactorySpec extends ObjectBehavior
{
    function it_implements_interface(): void
    {
        $this->shouldImplement(CPUPlayerFactoryInterface::class);
    }

    function it_creates_cpu_player(): void
    {
        $this->create()->shouldBeAnInstanceOf(CPUPlayer::class);
    }
}
