<?php

namespace App\DataImporter\Football\Lineup;

use App\DataImporter\Football\FootballImporter;
use App\Entity\Game;
use App\Entity\Lineup;
use App\Entity\Team;

class LineupDataImporter extends FootballImporter
{
    public function import(): void
    {
        $games = $this->em->getRepository(Game::class)->findAll();

        foreach ($games as $game) {
            $params = [
                'fixture' => $game->getApiId(),
            ];
            $responses = $this->client->request('/fixtures/lineups', $params);

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

                $this->em->persist($lineup);
            }
        }
        $this->em->flush();
    }
}
