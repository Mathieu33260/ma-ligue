<?php

namespace App\DataImporter\Football\Event;

use App\DataImporter\Football\FootballImporter;
use App\Entity\Event;
use App\Entity\Game;
use App\Entity\Player;
use App\Entity\Team;

class EventDataImporter extends FootballImporter
{
    public function import(): void
    {
        $nbCalls = 0;

        $games = $this->em->getRepository(Game::class)->findAll();

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
        }
        $this->em->flush();
    }
}
