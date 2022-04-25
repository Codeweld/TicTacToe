<?php

declare(strict_types=1);

namespace App\Cli;

use App\Infrastructure\WebSocket\Server\WebSocketServerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class StartServerCommand extends Command
{
    public const DEFAULT_PORT = 8020;

    protected static $defaultName = 'ttt:server:start';

    public function __construct(
        private WebSocketServerInterface $webSocketServer,
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Start TicTacToe server')
            ->setHelp('This command allows you to start the TicTacToe server')
            ->addArgument(
                'port',
                InputArgument::OPTIONAL,
                'Port on which WebSocket server will be running',
                self::DEFAULT_PORT,
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->write('Starting TicTacToe server...');

        $this->webSocketServer->start($input->getArgument('port'));

        return 0;
    }
}
