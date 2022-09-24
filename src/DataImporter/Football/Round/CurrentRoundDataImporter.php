<?php

namespace App\DataImporter\Football\Round;

use App\DataImporter\Football\FootballImporter;
use App\Entity\League;
use App\Entity\Round;

class CurrentRoundDataImporter extends FootballImporter
{
    public function import(): void
    {
        $leagues = $this->em->getRepository(League::class)->findAll();

        foreach ($leagues as $league) {
            $params = [
                'league' => $league->getApiId(),
                'season' => $league->getSeason(),
                'current' => 'true',
            ];
            $responses = $this->client->request('/fixtures/rounds', $params);

            $roundApi = $responses['response'][0];

            $existingRound = $this->em->getRepository(Round::class)
                ->findOneBy(['league' => $league, 'number' => $roundApi]);

            if (null !== $existingRound) {
                $existingRound->setCurrent(true);

                $this->em->persist($existingRound);
            }
        }
        $this->em->flush();
    }
}
