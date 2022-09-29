<?php

namespace App\DataImporter\Football\Game;

use App\DataImporter\Football\FootballImporter;
use App\Entity\Game;
use App\Entity\League;
use App\Entity\Round;
use App\Entity\Stadium;
use App\Entity\Team;
use DateTimeImmutable;

class GameDataImporter extends FootballImporter
{
    public function import(): void
    {
        $leagues = $this->em->getRepository(League::class)->findAll();

        foreach ($leagues as $league) {
            $params = [
                'league' => $league->getApiId(),
                'season' => $league->getSeason(),
            ];
            $responses = $this->client->request('/fixtures', $params);

            $gamesApi = $responses['response'];

            foreach ($gamesApi as $gameApi) {
                $existingGame = $this->em->getRepository(Game::class)
                    ->findOneBy(['apiId' => $gameApi['fixture']['id']]);

                $game = $existingGame ?? new Game();
                $game->setApiId($gameApi['fixture']['id']);
                $game->setDate(new DateTimeImmutable($gameApi['fixture']['date']));
                $game->setStatus($gameApi['fixture']['status']['long']);
                $game->setStatusCode($gameApi['fixture']['status']['short']);
                $game->setElapsed($gameApi['fixture']['status']['elapsed']);
                $game->setReferee($gameApi['fixture']['referee']);
                $game->setGoalsHometeam($gameApi['goals']['home']);
                $game->setGoalsAwayteam($gameApi['goals']['away']);

                if (null !== $gameApi['fixture']['venue']['id']) {
                    $existingStadium = $this->em->getRepository(Stadium::class)
                        ->findOneBy(['apiId' => $gameApi['fixture']['venue']['id']]);

                    $stadium = $existingStadium ?? new Stadium();
                    if (null === $existingStadium) {
                        $stadium->setApiId($gameApi['fixture']['venue']['id']);
                        $stadium->setName($gameApi['fixture']['venue']['name']);
                        $stadium->setCity($gameApi['fixture']['venue']['city']);
                    }

                    $game->setStadium($stadium);

                    $this->em->persist($stadium);
                }

                $hometeam = $this->em->getRepository(Team::class)
                    ->findOneBy(['apiId' => $gameApi['teams']['home']['id']]);

                $awayteam = $this->em->getRepository(Team::class)
                    ->findOneBy(['apiId' => $gameApi['teams']['away']['id']]);

                $game->setHometeam($hometeam);
                $game->setAwayteam($awayteam);

                $round = $this->em->getRepository(Round::class)
                    ->findOneBy(['number' => $gameApi['league']['round'], 'league' => $league]);

                $game->setRound($round);

                $game->setLeague($league);

                $this->em->persist($game);
            }
        }
        $this->em->flush();
    }
}
