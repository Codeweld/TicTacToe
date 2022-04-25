<?php

declare(strict_types=1);

namespace App\Application\Handler;

use App\Application\DTO\Move;
use App\Application\DTO\StartGame;
use App\Application\Factory\HumanPlayerFactoryInterface;
use App\Application\Iterator\TableIterator;
use App\Application\Notifier\PlayersNotifierInterface;
use App\Application\Provider\TableProviderInterface;
use App\Application\Resolver\CPUPlayerMoveResolverInterface;
use App\Domain\Model\TableInterface;
use Webmozart\Assert\Assert;

final class GameHandler implements GameHandlerInterface
{
    private TableIterator $tables;

    public function __construct(
        private TableProviderInterface $tableProvider,
        private HumanPlayerFactoryInterface $humanPlayerFactory,
        private CPUPlayerMoveResolverInterface $CPUPlayerMoveResolver,
        private PlayersNotifierInterface $playersNotifier,
    ) {
        $this->tables = new TableIterator();
    }

    public function handleGameStart(StartGame $startGameDTO): void
    {
        $table = $this->tableProvider->provide($startGameDTO);

        $humanPlayer = $this->humanPlayerFactory
            ->createWithSymbolAndConnectionIdentifier(
                $startGameDTO->getSymbol(),
                $startGameDTO->getConnectionIdentifier(),
            )
        ;

        $table->addPlayer($humanPlayer);
        $humanPlayer->setTable($table);

        $this->tables->add($table);

        if (false === $table->isComplete()) {
            return;
        }

        $this->playersNotifier->propagateTableState($table);
    }

    public function handleMove(Move $moveDTO): void
    {
        $table = $this->tables->getTableByPlayerConnectionIdentifier(
            $moveDTO->getConnectionIdentifier(),
        );

        Assert::notNull($table);

        $humanPlayer = $table->getHumanPlayerByConnectionIdentifier(
            $moveDTO->getConnectionIdentifier(),
        );

        Assert::notNull($humanPlayer);

        $humanPlayer->move($moveDTO->getX(), $moveDTO->getY());
        $this->propagateChangeForTable($table);

        $this->handleCPUMoveForTable($table);
    }

    private function handleCPUMoveForTable(TableInterface $table): void
    {
        $CPUPlayer = $table->getCPUPlayer();

        Assert::notNull($CPUPlayer);

        $CPUMove = $this->CPUPlayerMoveResolver->resolve($CPUPlayer);
        $CPUPlayer->move($CPUMove->getX(), $CPUMove->getY());

        $this->propagateChangeForTable($table);
    }

    private function propagateChangeForTable(TableInterface $table): void
    {
        $this->playersNotifier->propagateTableState($table);

        if (true === $table->hasResult()) {
            $this->playersNotifier->propagateEndGame($table);
        }
    }
}
