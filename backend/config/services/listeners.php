<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use App\Application\Event\DataReceivedEvent;
use App\Application\Event\GameEnded;
use App\Application\Event\TableStateChanged;
use App\Application\EventListener\DataReceivedEventListener;
use App\Infrastructure\WebSocket\EventListener\SerializableEventListener;

return function(ContainerConfigurator $configurator) {
    $services = $configurator
        ->services()
        ->defaults()
        ->autowire()
        ->autoconfigure()
        ->private()
    ;

    $services
        ->set(DataReceivedEventListener::class)
        ->tag('kernel.event_listener', [
            'event' => DataReceivedEvent::class,
            'method' => 'onDataReceived',
        ])
    ;

    $services
        ->set('app.infrastructure.websocket.event_listener.table_state_changed')
        ->class(SerializableEventListener::class)
        ->tag('kernel.event_listener', [
            'event' => TableStateChanged::class,
            'method' => 'onSerializableEventReceived',
        ])
    ;

    $services
        ->set('app.infrastructure.websocket.event_listener.game_ended')
        ->class(SerializableEventListener::class)
        ->tag('kernel.event_listener', [
            'event' => GameEnded::class,
            'method' => 'onSerializableEventReceived',
        ])
    ;
};
