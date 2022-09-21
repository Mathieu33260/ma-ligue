<?php

namespace App\Listener\GameStat;

use App\Entity\GameStat;
use DateTimeImmutable;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class GameStatPreUpdateListener
{
    public function preUpdate(GameStat $gameStat, LifecycleEventArgs $event): void
    {
        $gameStat->setUpdatedAt(new DateTimeImmutable());
    }
}
