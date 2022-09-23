<?php

namespace App\DataImporter\Football\Round;

use App\DataImporter\Football\FootballImporter;
use App\Entity\League;
use App\Entity\Round;

class RoundDataImporter extends FootballImporter
{
    public function import(): void
    {
        $leagues = $this->em->getRepository(League::class)->findAll();

        foreach ($leagues as $league) {
            $params = [
                'league' => $league->getApiId(),
                'season' => $league->getSeason(),
            ];
            $responses = $this->client->request('/fixtures/rounds', $params);

            $roundsApi = $responses['response'];

            foreach ($roundsApi as $roundApi) {
                $existingRound = $this->em->getRepository(Round::class)
                    ->findOneBy(['league' => $league, 'number' => $roundApi]);

                $round = $existingRound ?? new Round();
                $round->setNumber($roundApi);
                $round->setCurrent(false);

                $round->setLeague($league);

                $this->em->persist($round);
            }
        }
        $this->em->flush();
    }
}
