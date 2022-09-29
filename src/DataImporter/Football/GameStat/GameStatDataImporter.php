<?php

namespace App\DataImporter\Football\GameStat;

use App\DataImporter\Football\FootballImporter;
use App\Entity\Game;
use App\Entity\GameStat;
use App\Entity\Team;

class GameStatDataImporter extends FootballImporter
{
    public function import(): void
    {
        $nbCalls = 0;

        $games = $this->em->getRepository(Game::class)->findAll();

        foreach ($games as $game) {
            $params = [
                'fixture' => $game->getApiId(),
            ];
            if ($nbCalls > 298) {
                sleep(60);
                $nbCalls = 0;
            }
            $responses = $this->client->request('/fixtures/statistics', $params);
            $nbCalls++;

            $gamesApi = $responses['response'];

            foreach ($gamesApi as $gameStatApi) {
                $team = $this->em->getRepository(Team::class)
                    ->findOneBy(['apiId' => $gameStatApi['team']['id']]);

                foreach ($gameStatApi['statistics'] as $statisticApi) {
                    $existingGameStat = $this->em->getRepository(GameStat::class)
                        ->findOneBy(['game' => $game, 'team' => $team, 'type' => $statisticApi['type']]);

                    $gameStat = $existingGameStat ?? new GameStat();
                    $gameStat->setType($statisticApi['type']);
                    $gameStat->setValue($statisticApi['value']);

                    $gameStat->setTeam($team);

                    $gameStat->setGame($game);

                    $this->em->persist($gameStat);
                }
            }
        }
        $this->em->flush();
    }
}
