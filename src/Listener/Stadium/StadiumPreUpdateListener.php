<?php

namespace App\Listener\Stadium;

use App\Entity\Stadium;
use DateTimeImmutable;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class StadiumPreUpdateListener
{
    public function preUpdate(Stadium $stadium, LifecycleEventArgs $event): void
    {
        $stadium->setUpdatedAt(new DateTimeImmutable());
    }
}
