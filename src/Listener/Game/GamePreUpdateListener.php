<?php

namespace App\Listener\Game;

use App\Entity\Game;
use DateTimeImmutable;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class GamePreUpdateListener
{
    public function preUpdate(Game $game, LifecycleEventArgs $event): void
    {
        $game->setUpdatedAt(new DateTimeImmutable());
    }
}
