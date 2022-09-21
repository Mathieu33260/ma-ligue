<?php

namespace App\Listener\PlayerStat;

use App\Entity\PlayerStat;
use DateTimeImmutable;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class PlayerStatPreUpdateListener
{
    public function preUpdate(PlayerStat $playerStat, LifecycleEventArgs $event): void
    {
        $playerStat->setUpdatedAt(new DateTimeImmutable());
    }
}
