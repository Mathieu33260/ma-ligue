<?php

namespace App\Listener\User;

use App\Entity\User;
use DateTimeImmutable;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class UserPreUpdateListener
{
    public function preUpdate(User $user, LifecycleEventArgs $event): void
    {
        $user->setUpdatedAt(new DateTimeImmutable());
    }
}
