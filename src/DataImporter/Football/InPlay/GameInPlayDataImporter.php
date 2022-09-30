<?php

namespace App\DataImporter\Football\InPlay;

use App\DataImporter\Football\FootballImporter;
use App\Entity\Event;
use App\Entity\Game;
use App\Entity\GameStat;
use App\Entity\Player;
use App\Entity\Team;
use DateTimeImmutable;

class GameInPlayDataImporter extends FootballImporter
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
                'id' => $game->getApiId(),
            ];
            if ($nbCalls > 298) {
                sleep(60);
                $nbCalls = 0;
            }
            $responses = $this->client->request('/fixtures', $params);
            $nbCalls++;

            $gameApi = $responses['response'][0];

            $game->setDate(new DateTimeImmutable($gameApi['fixture']['date']));
            $game->setStatus($gameApi['fixture']['status']['long']);
            $game->setStatusCode($gameApi['fixture']['status']['short']);
            $game->setElapsed($gameApi['fixture']['status']['elapsed']);
            $game->setReferee($gameApi['fixture']['referee']);
            $game->setGoalsHometeam($gameApi['goals']['home']);
            $game->setGoalsAwayteam($gameApi['goals']['away']);

            foreach ($gameApi['statistics'] as $statisticsApi) {
                $team = $this->em->getRepository(Team::class)
                    ->findOneBy(['apiId' => $statisticsApi['team']['id']]);

                foreach ($statisticsApi['statistics'] as $statisticApi) {
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

            $existingEvents = $this->em->getRepository(Event::class)->findBy(['game' => $game]);

            foreach ($existingEvents as $existingEvent) {
                $this->em->remove($existingEvent);
            }

            if (count($gameApi['events']) > 0) {
                foreach ($gameApi['events'] as $eventApi) {
                    $event = new Event();
                    $event->setType($eventApi['type']);
                    $event->setDetail($eventApi['detail']);
                    $event->setElapsed($eventApi['time']['elapsed']);
                    $event->setElapsedExtra($eventApi['time']['extra']);

                    $event->setGame($game);

                    if (null !== $eventApi['team']['id']) {
                        $team = $this->em->getRepository(Team::class)
                            ->findOneBy(['apiId' => $eventApi['team']['id']]);

                        $event->setTeam($team);
                    }

                    if (null !== $eventApi['player']['id']) {
                        $player = $this->em->getRepository(Player::class)
                            ->findOneBy(['apiId' => $eventApi['player']['id']]);

                        $event->setPlayer($player);
                    }

                    if (null !== $eventApi['assist']['id']) {
                        $playerAssist = $this->em->getRepository(Player::class)
                            ->findOneBy(['apiId' => $eventApi['assist']['id']]);

                        $event->setPlayerAssist($playerAssist);
                    }

                    $this->em->persist($event);
                }
            }
            $this->em->persist($game);
        }
        $this->em->flush();
    }
}
