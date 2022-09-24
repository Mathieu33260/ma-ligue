<?php

namespace App\DataImporter\Football\TeamStat;

use App\DataImporter\Football\FootballImporter;
use App\Entity\League;
use App\Entity\Standing;
use App\Entity\TeamStat;

class TeamStatDataImporter extends FootballImporter
{
    public function import(): void
    {
        $leagues = $this->em->getRepository(League::class)->findAll();

        foreach ($leagues as $league) {

            $standings = $this->em->getRepository(Standing::class)->findBy(['league' => $league]);

            foreach ($standings as $standing) {
                $team = $standing->getTeam();

                $params = [
                    'league' => $league->getApiId(),
                    'season' => $league->getSeason(),
                    'team' => $team->getApiId(),
                ];
                $responses = $this->client->request('/teams/statistics', $params);

                $teamStatApi = $responses['response'];

                $existingTeamStat = $this->em->getRepository(TeamStat::class)
                    ->findOneBy(['team' => $team, 'league' => $league]);

                $teamStat = $existingTeamStat ?? new TeamStat();
                $teamStat->setWinsHome($teamStatApi['fixtures']['wins']['home']);
                $teamStat->setWinsAway($teamStatApi['fixtures']['wins']['away']);
                $teamStat->setLosesHome($teamStatApi['fixtures']['loses']['home']);
                $teamStat->setLosesAway($teamStatApi['fixtures']['loses']['away']);
                $teamStat->setDrawsHome($teamStatApi['fixtures']['draws']['home']);
                $teamStat->setDrawsAway($teamStatApi['fixtures']['draws']['away']);
                $teamStat->setGoalsForHome($teamStatApi['goals']['for']['total']['home']);
                $teamStat->setGoalsForAway($teamStatApi['goals']['for']['total']['away']);
                $teamStat->setGoalsAgainstHome($teamStatApi['goals']['against']['total']['home']);
                $teamStat->setGoalsAgainstAway($teamStatApi['goals']['against']['total']['away']);
                
                $yellowCard = 0;
                foreach ($teamStatApi['cards']['yellow'] as $card) {
                    $yellowCard += $card['total'];
                }
                $teamStat->setYellowCard($yellowCard);

                $redCard = 0;
                foreach ($teamStatApi['cards']['red'] as $card) {
                    $redCard += $card['total'];
                }
                $teamStat->setRedCard($redCard);

                $teamStat->setLeague($league);
                $teamStat->setTeam($team);

                $this->em->persist($teamStat);
            }
        }
        $this->em->flush();
    }
}
