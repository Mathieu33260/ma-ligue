<?php

namespace App\Listener\Round;

use App\Entity\Round;
use DateTimeImmutable;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class RoundPreUpdateListener
{
    public function preUpdate(Round $round, LifecycleEventArgs $event): void
    {
        $round->setUpdatedAt(new DateTimeImmutable());
    }
}
