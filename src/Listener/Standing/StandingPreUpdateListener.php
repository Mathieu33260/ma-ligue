<?php

namespace App\Listener\Standing;

use App\Entity\Standing;
use DateTimeImmutable;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class StandingPreUpdateListener
{
    public function preUpdate(Standing $standing, LifecycleEventArgs $event): void
    {
        $standing->setUpdatedAt(new DateTimeImmutable());
    }
}
