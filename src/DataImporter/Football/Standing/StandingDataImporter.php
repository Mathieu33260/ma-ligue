<?php

namespace App\DataImporter\Football\Standing;

use App\DataImporter\Football\FootballImporter;
use App\Entity\League;
use App\Entity\Standing;
use App\Entity\Team;

class StandingDataImporter extends FootballImporter
{
    public function import(): void
    {
        $leagues = $this->em->getRepository(League::class)->findAll();

        foreach ($leagues as $league) {
            $params = [
                'league' => $league->getApiId(),
                'season' => $league->getSeason(),
            ];

            $responses = $this->client->request('/standings', $params);

            $standingsApi = $responses['response'][0]['league']['standings'][0];

            foreach ($standingsApi as $standingApi) {
                $team = $this->em->getRepository(Team::class)->findOneBy(['apiId' => $standingApi['team']['id']]);

                if (null === $team) {
                    continue;
                }

                $existingStanding = $this->em->getRepository(Standing::class)
                    ->findOneBy(['league' => $league, 'team' => $team]);

                $standing = $existingStanding ?? new Standing();
                $standing->setPoints($standingApi['points']);
                $standing->setGoalsDiff($standingApi['goalsDiff']);
                $standing->setRank($standingApi['rank']);
                $standing->setStatus($standingApi['status']);
                $standing->setDescription($standingApi['description']);
                $standing->setForm($standingApi['form']);
                $standing->setMatchsPlayed($standingApi['all']['played']);
                $standing->setWins($standingApi['all']['win']);
                $standing->setLoses($standingApi['all']['lose']);
                $standing->setDraws($standingApi['all']['draw']);
                $standing->setGoalsFor($standingApi['all']['goals']['for']);
                $standing->setGoalsAgainst($standingApi['all']['goals']['against']);

                $standing->setTeam($team);
                $standing->setLeague($league);

                $this->em->persist($standing);
            }
        }
        $this->em->flush();
    }
}
