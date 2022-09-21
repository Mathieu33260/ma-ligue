<?php

namespace App\Listener\Event;

use App\Entity\Event;
use DateTimeImmutable;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class EventPreUpdateListener
{
    public function preUpdate(Event $eventEntity, LifecycleEventArgs $event): void
    {
        $eventEntity->setUpdatedAt(new DateTimeImmutable());
    }
}
