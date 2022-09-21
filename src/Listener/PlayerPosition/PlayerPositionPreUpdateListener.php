<?php

namespace App\Listener\PlayerPosition;

use App\Entity\PlayerPosition;
use DateTimeImmutable;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class PlayerPositionPreUpdateListener
{
    public function preUpdate(PlayerPosition $playerPosition, LifecycleEventArgs $event): void
    {
        $playerPosition->setUpdatedAt(new DateTimeImmutable());
    }
}
