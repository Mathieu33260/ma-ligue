<?php

namespace App\DataImporter\Football\InPlay;

use App\DataImporter\Football\FootballImporter;
use App\Entity\Game;
use App\Entity\Lineup;
use App\Entity\Player;
use App\Entity\PlayerPosition;
use App\Entity\Team;
use DateTimeImmutable;

class LineupPlayerPositionInPlayDataImporter extends FootballImporter
{
    public function import(): void
    {
        $nbCalls = 0;

        $start = new DateTimeImmutable();
        $end = new DateTimeImmutable();
        $end = $end->modify('+40 minute');

        $games = $this->em->getRepository(Game::class)
            ->findByToCome($start, $end);

        foreach ($games as $game) {
            $params = [
                'fixture' => $game->getApiId(),
            ];
            if ($nbCalls > 298) {
                sleep(60);
                $nbCalls = 0;
            }
            $responses = $this->client->request('/fixtures/lineups', $params);
            $nbCalls++;

            $lineupsApi = $responses['response'];

            foreach ($lineupsApi as $lineupApi) {
                $team = $this->em->getRepository(Team::class)
                    ->findOneBy(['apiId' => $lineupApi['team']['id']]);

                $existingLineup = $this->em->getRepository(Lineup::class)
                    ->findOneBy(['game' => $game, 'team' => $team]);

                $lineup = $existingLineup ?? new Lineup();
                $lineup->setFormation($lineupApi['formation']);

                $lineup->setGame($game);
                $lineup->setTeam($team);

                foreach ($lineupApi['startXI'] as $playerApi) {
                    $player = $this->em->getRepository(Player::class)
                        ->findOneBy(['apiId' => $playerApi['player']['id']]);

                    if (null === $player) {
                        $params = [
                            'id' => $playerApi['player']['id'],
                            'league' => $game->getLeague()->getApiId(),
                            'season' => $game->getLeague()->getSeason(),
                        ];
                        if ($nbCalls > 298) {
                            sleep(60);
                            $nbCalls = 0;
                        }
                        $responses = $this->client->request('/players', $params);
                        $nbCalls++;

                        $player = new Player();

                        if (!array_key_exists(0, $responses['response'])) {
                            $player->setApiId($playerApi['player']['id']);
                            $player->setName($playerApi['player']['name']);
                        } else {
                            $playerApi2 = $responses['response'][0]['player'];

                            $player->setApiId($playerApi2['id']);
                            $player->setName($playerApi2['name']);
                            $player->setAge($playerApi2['age']);
                            $player->setPhoto($playerApi2['photo']);
                        }

                        $player->setTeam($team);

                        $this->em->persist($player);
                    }

                    $existingPlayerPosition = $this->em->getRepository(PlayerPosition::class)
                        ->findOneBy(['player' => $player, 'lineup' => $lineup]);

                    $playerPosition = $existingPlayerPosition ?? new PlayerPosition();
                    $playerPosition->setNumber($playerApi['player']['number']);
                    $playerPosition->setPosition($playerApi['player']['pos']);
                    $playerPosition->setGrid($playerApi['player']['grid']);
                    $playerPosition->setIsStarter(true);

                    $playerPosition->setPlayer($player);

                    $playerPosition->setLineup($lineup);

                    $this->em->persist($playerPosition);
                }

                foreach ($lineupApi['substitutes'] as $playerApi) {
                    $player = $this->em->getRepository(Player::class)
                        ->findOneBy(['apiId' => $playerApi['player']['id']]);

                    if (null === $player) {
                        $params = [
                            'id' => $playerApi['player']['id'],
                            'league' => $game->getLeague()->getApiId(),
                            'season' => $game->getLeague()->getSeason(),
                        ];
                        if ($nbCalls > 298) {
                            sleep(60);
                            $nbCalls = 0;
                        }
                        $responses = $this->client->request('/players', $params);
                        $nbCalls++;

                        $player = new Player();

                        if (!array_key_exists(0, $responses['response'])) {
                            $player->setApiId($playerApi['player']['id']);
                            $player->setName($playerApi['player']['name']);
                        } else {
                            $playerApi2 = $responses['response'][0]['player'];

                            $player->setApiId($playerApi2['id']);
                            $player->setName($playerApi2['name']);
                            $player->setAge($playerApi2['age']);
                            $player->setPhoto($playerApi2['photo']);
                        }

                        $player->setTeam($team);

                        $this->em->persist($player);
                    }

                    $existingPlayerPosition = $this->em->getRepository(PlayerPosition::class)
                        ->findOneBy(['player' => $player, 'lineup' => $lineup]);

                    $playerPosition = $existingPlayerPosition ?? new PlayerPosition();
                    $playerPosition->setNumber($playerApi['player']['number']);
                    $playerPosition->setPosition($playerApi['player']['pos']);
                    $playerPosition->setGrid($playerApi['player']['grid']);
                    $playerPosition->setIsStarter(false);

                    $playerPosition->setPlayer($player);

                    $playerPosition->setLineup($lineup);

                    $this->em->persist($playerPosition);
                }
                $this->em->persist($lineup);
            }
        }
        $this->em->flush();
    }
}
