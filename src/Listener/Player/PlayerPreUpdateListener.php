<?php

namespace App\Listener\Player;

use App\Entity\Player;
use DateTimeImmutable;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class PlayerPreUpdateListener
{
    public function preUpdate(Player $player, LifecycleEventArgs $event): void
    {
        $player->setUpdatedAt(new DateTimeImmutable());
    }
}
