<?php

namespace App\Utils\Football;

class StatusUtils
{
    public const STATUS_TIME_TO_BE_DEFINED = 'TBD';
    public const STATUS_NOT_STARTED = 'NS';
    public const STATUS_FIRST_HALF = '1H';
    public const STATUS_SECOND_HALF = '2H';
    public const STATUS_HALF_TIME = 'HT';
    public const STATUS_EXTRA_TIME = 'ET';
    public const STATUS_PENALTY_IN_PROGRESS = 'P';
    public const STATUS_MATCH_FINISHED = 'FT';
    public const STATUS_MATCH_FINISHED_AFTER_EXTRA_TIME = 'AET';
    public const STATUS_MATCH_FINISHED_AFTER_PENALTY = 'PEN';
    public const STATUS_BREAK_TIME = 'BT';
    public const STATUS_MATCH_SUSPENDED = 'SUSP';
    public const STATUS_MATCH_INTERRUPTED = 'INT';
    public const STATUS_MATCH_POSTPONED = 'PST';
    public const STATUS_MATCH_CANCELED = 'CANC';
    public const STATUS_MATCH_ABANDONED = 'ABD';
    public const STATUS_TECHNICAL_LOST = 'AWD';
    public const STATUS_WALK_OVER = 'WO';
    public const STATUS_IN_PROGRESS = 'LIVE';

    public const STATUS_TRANSLATE = [
        self::STATUS_TIME_TO_BE_DEFINED => 'Planifié',
        self::STATUS_NOT_STARTED => 'À venir',
        self::STATUS_FIRST_HALF => 'Première mi-temps',
        self::STATUS_SECOND_HALF => 'Deuxième mi-temps',
        self::STATUS_HALF_TIME => 'Mi-temps',
        self::STATUS_EXTRA_TIME => 'Prolongation',
        self::STATUS_PENALTY_IN_PROGRESS => 'Penaltys',
        self::STATUS_MATCH_FINISHED => 'Terminé',
        self::STATUS_MATCH_FINISHED_AFTER_EXTRA_TIME => 'Terminé',
        self::STATUS_MATCH_FINISHED_AFTER_PENALTY => 'Terminé',
        self::STATUS_BREAK_TIME => 'Mi-temps prolongation',
        self::STATUS_MATCH_SUSPENDED => 'Match suspendu',
        self::STATUS_MATCH_INTERRUPTED => 'Match interrompu',
        self::STATUS_MATCH_POSTPONED => 'Match reporté',
        self::STATUS_MATCH_CANCELED => 'Match annulé',
        self::STATUS_MATCH_ABANDONED => 'Match abandonné',
        self::STATUS_TECHNICAL_LOST => 'Forfait',
        self::STATUS_WALK_OVER => 'Forfait',
        self::STATUS_IN_PROGRESS => 'En cours',
    ];

    public function getStatus(): array
    {
        return self::STATUS_TRANSLATE;
    }
}
