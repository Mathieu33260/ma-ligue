<?php

namespace App\Listener\TeamStat;

use App\Entity\TeamStat;
use DateTimeImmutable;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class TeamStatPreUpdateListener
{
    public function preUpdate(TeamStat $teamStat, LifecycleEventArgs $event): void
    {
        $teamStat->setUpdatedAt(new DateTimeImmutable());
    }
}
