<?php

namespace Salesforce\Common;

use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Contracts\EventDispatcher\Event;

/**
 * Can be extended by classes that dispatch events using the event dispatcher
 */
abstract class AbstractHasDispatcher
{
    protected ?EventDispatcherInterface $eventDispatcher = null;

    public function setEventDispatcher(EventDispatcherInterface $eventDispatcher): void
    {
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * Get event dispatcher
     *
     * If no event dispatcher is supplied, a new one is created. This one will
     * then be used internally by the Accelerate library.
     */
    public function getEventDispatcher(): EventDispatcherInterface
    {
        if (!$this->eventDispatcher) {
            $this->eventDispatcher = new EventDispatcher();
        }
        return $this->eventDispatcher;
    }

    protected function dispatch(Event $event, ?string $name): Event
    {
        return $this->getEventDispatcher()->dispatch($event, $name);
    }
}

