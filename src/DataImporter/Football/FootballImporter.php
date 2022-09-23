<?php

namespace App\DataImporter\Football;

use App\Client\ApiFootballClient;
use Doctrine\ORM\EntityManagerInterface;

abstract class FootballImporter
{
    protected ApiFootballClient $client;
    protected EntityManagerInterface $em;

    public function __construct(ApiFootballClient $client, EntityManagerInterface $em)
    {
        $this->client = $client;
        $this->em = $em;
    }

    abstract protected function import(): void;
}
