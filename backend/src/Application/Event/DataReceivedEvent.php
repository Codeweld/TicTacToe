<?php

declare(strict_types=1);

namespace App\Application\Event;

use Symfony\Contracts\EventDispatcher\Event;

final class DataReceivedEvent extends Event
{
    public function __construct(
        private string $data,
        private string $connectionIdentifier,
    ) {
    }

    public function getData(): string
    {
        return $this->data;
    }

    public function getConnectionIdentifier(): string
    {
        return $this->connectionIdentifier;
    }
}
