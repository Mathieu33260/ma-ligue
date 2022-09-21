<?php

namespace App\Listener\Team;

use App\Entity\Team;
use DateTimeImmutable;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class TeamPreUpdateListener
{
    public function preUpdate(Team $team, LifecycleEventArgs $event): void
    {
        $team->setUpdatedAt(new DateTimeImmutable());
    }
}
