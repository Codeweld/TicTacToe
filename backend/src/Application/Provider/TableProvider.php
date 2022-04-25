<?php

declare(strict_types=1);

namespace App\Application\Provider;

use App\Application\DTO\StartGame;
use App\Application\Factory\CPUPlayerFactoryInterface;
use App\Application\Factory\TableFactoryInterface;
use App\Domain\Model\TableInterface;
use Webmozart\Assert\Assert;

final class TableProvider implements TableProviderInterface
{
    public const GAME_MODE_CPU_RANDOM = 'cpu-random';

    public function __construct(
        private TableFactoryInterface $tableFactory,
        private CPUPlayerFactoryInterface $CPUPlayerFactory,
        private SymbolProviderInterface $symbolProvider,
    ) {
    }

    public function provide(StartGame $startGameDTO): TableInterface
    {
        Assert::inArray(
            $startGameDTO->getMode(),
            [self::GAME_MODE_CPU_RANDOM],
            sprintf(
                'Unsupported game mode [%s]',
                $startGameDTO->getMode(),
            )
        );

        $table = $this->tableFactory->createWithSize(
            $startGameDTO->getTableSize(),
        );

        $CPUPlayerSymbol = $this->symbolProvider->provideOtherSymbol(
            $startGameDTO->getSymbol(),
        );

        $CPUPlayer = $this->CPUPlayerFactory->create();
        $CPUPlayer->setSymbol($CPUPlayerSymbol);

        $table->addPlayer($CPUPlayer);
        $CPUPlayer->setTable($table);

        return $table;
    }
}
