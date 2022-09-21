<?php

namespace App\Listener\League;

use App\Entity\League;
use DateTimeImmutable;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class LeaguePreUpdateListener
{
    public function preUpdate(League $league, LifecycleEventArgs $event): void
    {
        $league->setUpdatedAt(new DateTimeImmutable());
    }
}
