<?php

namespace App\Listener\Lineup;

use App\Entity\Lineup;
use DateTimeImmutable;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class LineupPreUpdateListener
{
    public function preUpdate(Lineup $lineup, LifecycleEventArgs $event): void
    {
        $lineup->setUpdatedAt(new DateTimeImmutable());
    }
}
