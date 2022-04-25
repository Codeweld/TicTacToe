<?php

declare(strict_types=1);

namespace spec\App\Domain\Model;

use App\Domain\Model\TableInterface;
use PhpSpec\ObjectBehavior;

final class TableSpec extends ObjectBehavior
{
    function let(): void
    {
        $this->beConstructedWith(3);
    }

    function it_implements_interface(): void
    {
        $this->shouldImplement(TableInterface::class);
    }

    function it_checks_whether_any_move_is_possible_and_returns_true_if_so(): void
    {
        $this
            ->isAnyMovePossible()
            ->shouldReturn(true)
        ;
    }

    function it_checks_whether_any_move_is_possible_and_returns_false_if_not(): void
    {
        $this->setField(0, 0, 'x');
        $this->setField(0, 1, 'x');
        $this->setField(0, 2, 'o');
        $this->setField(1, 0, 'x');
        $this->setField(1, 1, 'o');
        $this->setField(1, 2, 'x');
        $this->setField(2, 0, 'o');
        $this->setField(2, 1, 'x');
        $this->setField(2, 2, 'x');

        $this
            ->isAnyMovePossible()
            ->shouldReturn(false)
        ;
    }

    function it_checks_whether_the_same_symbol_is_set_for_all_fields_in_x_axis_and_returns_true_if_so(): void
    {
        $this->setField(0, 0, 'x');
        $this->setField(0, 1, 'x');
        $this->setField(0, 2, 'x');

        $this
            ->hasTheSameSymbolForAllInXAxis('x', 0)
            ->shouldReturn(true)
        ;
    }

    function it_checks_whether_the_same_symbol_is_set_for_all_fields_in_x_axis_and_returns_false_if_not(): void
    {
        $this->setField(0, 0, 'x');
        $this->setField(0, 1, 'o');
        $this->setField(0, 2, 'x');

        $this
            ->hasTheSameSymbolForAllInXAxis('x', 0)
            ->shouldReturn(false)
        ;
    }

    function it_checks_whether_the_same_symbol_is_set_for_all_fields_in_y_axis_and_returns_true_if_so(): void
    {
        $this->setField(0, 1, 'y');
        $this->setField(1, 1, 'y');
        $this->setField(2, 1, 'y');

        $this
            ->hasTheSameSymbolForAllInYAxis('y', 1)
            ->shouldReturn(true)
        ;
    }

    function it_checks_whether_the_same_symbol_is_set_for_all_fields_in_y_axis_and_returns_false_if_not(): void
    {
        $this->setField(0, 1, 'x');
        $this->setField(1, 1, 'y');
        $this->setField(2, 1, 'y');

        $this
            ->hasTheSameSymbolForAllInYAxis('y', 1)
            ->shouldReturn(false)
        ;
    }

    function it_checks_whether_the_same_symbol_is_set_for_all_fields_in_first_diagonal_and_returns_true_if_so(): void
    {
        $this->setField(0, 0, 'x');
        $this->setField(1, 1, 'x');
        $this->setField(2, 2, 'x');

        $this
            ->hasTheSameSymbolForAllInFirstDiagonal('x')
            ->shouldReturn(true)
        ;
    }

    function it_checks_whether_the_same_symbol_is_set_for_all_fields_in_first_diagonal_and_returns_false_if_not(): void
    {
        $this->setField(0, 0, 'x');
        $this->setField(1, 1, 'x');
        $this->setField(2, 2, 'y');

        $this
            ->hasTheSameSymbolForAllInFirstDiagonal('x')
            ->shouldReturn(false)
        ;
    }

    function it_checks_whether_the_same_symbol_is_set_for_all_fields_in_second_diagonal_and_returns_true_if_so(): void
    {
        $this->setField(0, 2, 'y');
        $this->setField(1, 1, 'y');
        $this->setField(2, 0, 'y');

        $this
            ->hasTheSameSymbolForAllInSecondDiagonal('y')
            ->shouldReturn(true)
        ;
    }

    function it_checks_whether_the_same_symbol_is_set_for_all_fields_in_second_diagonal_and_returns_false_if_not(): void
    {
        $this->setField(0, 2, 'x');
        $this->setField(1, 1, 'y');
        $this->setField(2, 0, 'y');

        $this
            ->hasTheSameSymbolForAllInSecondDiagonal('y')
            ->shouldReturn(false)
        ;
    }
}
