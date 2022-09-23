<?php

namespace App\DataImporter\Football\League;

use App\DataImporter\Football\FootballImporter;
use App\Entity\League;
use DateTimeImmutable;

class LeagueDataImporter extends FootballImporter
{
    public function import(): void
    {
        $leagues = [
            'Ligue 1' => 61,
            'Ligue 2' => 62,
        ];
        $season = 2022;

        foreach ($leagues as $leagueName => $leagueApiId) {
            $params = [
                'id' => $leagueApiId,
                'season' => $season,
            ];

            $responses = $this->client->request('/leagues', $params);
            $leagueApi = $responses['response'][0];

            $existingLeague = $this->em->getRepository(League::class)->findOneBy(['apiId' => $leagueApi['league']['id']]);

            $league = $existingLeague ?? new League();
            $league->setApiId($leagueApi['league']['id']);
            $league->setName($leagueApi['league']['name']);
            $league->setType($leagueApi['league']['type']);
            $league->setLogo($leagueApi['league']['logo']);
            $league->setCountry($leagueApi['country']['name']);
            $league->setFlag($leagueApi['country']['flag']);
            $league->setStart(new DateTimeImmutable($leagueApi['seasons'][0]['start']));
            $league->setEnd(new DateTimeImmutable($leagueApi['seasons'][0]['end']));
            $league->setSeason($leagueApi['seasons'][0]['year']);

            $this->em->persist($league);
        }
        $this->em->flush();
    }
}
