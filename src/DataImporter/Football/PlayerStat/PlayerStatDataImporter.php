<?php

namespace App\DataImporter\Football\PlayerStat;

use App\DataImporter\Football\FootballImporter;
use App\Entity\League;
use App\Entity\Player;
use App\Entity\PlayerStat;
use App\Entity\Team;

class PlayerStatDataImporter extends FootballImporter
{
    public function import(): void
    {
        $season = 2022;

        $leagues = $this->em->getRepository(League::class)->findAll();

        foreach ($leagues as $league) {

            $params = [
                'league' => $league->getApiId(),
                'season' => $season,
                'page' => 1,
            ];

            $responses = $this->client->request('/players', $params);

            $currentPage = $responses['paging']['current'];
            $maxPage = $responses['paging']['total'];

            while ($currentPage < $maxPage) {
                $params = [
                    'league' => $league->getApiId(),
                    'season' => $season,
                    'page' => $currentPage,
                ];

                $responses = $this->client->request('/players', $params);

                foreach ($responses['response'] as $playerApi) {
                    $playerApiPlayer = $playerApi['player'];

                    $player = $this->em->getRepository(Player::class)->findOneBy(['apiId' => $playerApiPlayer['id']]);

                    if (null === $player) {
                        continue;
                    }

                    $player->setNationality($playerApiPlayer['nationality']);
                    $player->setFirstName($playerApiPlayer['firstname']);
                    $player->setLastName($playerApiPlayer['lastname']);
                    $player->setInjured($playerApiPlayer['injured']);

                    $playerApiStat = $playerApi['statistics'];

                    foreach ($playerApiStat as $statApi) {
                        $team = $this->em->getRepository(Team::class)->findOneBy(['apiId' => $statApi['team']['id']]);

                        if (null === $team) {
                            continue;
                        }

                        $existingPlayerStat = $this->em->getRepository(PlayerStat::class)
                            ->findOneBy(['player' => $player, 'team' => $team, 'league' => $league]);

                        $playerStat = $existingPlayerStat ?? new PlayerStat();
                        $playerStat->setGoals($statApi['goals']['total']);
                        $playerStat->setGoalsAssists($statApi['goals']['assists']);
                        $playerStat->setGoalsConceded($statApi['goals']['conceded']);
                        $playerStat->setPasses($statApi['passes']['total']);
                        $playerStat->setPassesAccuracy($statApi['passes']['accuracy']);
                        $playerStat->setShots($statApi['shots']['total']);
                        $playerStat->setShotsOn($statApi['shots']['on']);
                        $playerStat->setCardYellow($statApi['cards']['yellow']);
                        $playerStat->setCardRed($statApi['cards']['red']);
                        $playerStat->setTitu($statApi['games']['lineups']);
                        $playerStat->setMinutesPlayed($statApi['games']['minutes']);
                        $playerStat->setGames($statApi['games']['appearences']);
                        $playerStat->setPenaltyOn($statApi['penalty']['scored']);
                        $playerStat->setPenaltyOut($statApi['penalty']['missed']);

                        $playerStat->setPlayer($player);

                        $playerStat->setTeam($team);

                        $playerStat->setLeague($league);

                        $this->em->persist($playerStat);
                    }
                    $this->em->persist($player);
                }

                $currentPage++;
            }
        }

        $this->em->flush();
    }
}
