<?php

namespace App\DataImporter\Football\Team;

use App\DataImporter\Football\FootballImporter;
use App\Entity\League;
use App\Entity\Stadium;
use App\Entity\Team;

class TeamDataImporter extends FootballImporter
{
    public function import(): void
    {
        $season = 2022;
        $leagues = $this->em->getRepository(League::class)->findBy(['season' => $season]);

        foreach ($leagues as $league) {
            $params = [
                'league' => $league->getApiId(),
                'season' => $season,
            ];

            $responses = $this->client->request('/teams', $params);

            foreach ($responses['response'] as $response) {
                $teamApi = $response['team'];
                $stadiumApi = $response['venue'];

                $existingTeam = $this->em->getRepository(Team::class)->findOneBy(['apiId' => $teamApi['id']]);
                if (null === $existingTeam) {
                    $team = new Team();

                    $stadium = new Stadium();
                } else {
                    $team = $existingTeam;

                    $stadium = $team->getStadium() ?? new Stadium();
                }

                $team->setApiId($teamApi['id']);
                $team->setName($teamApi['name']);
                $team->setCode($teamApi['code']);
                $team->setCountry($teamApi['country']);
                $team->setFounded($teamApi['founded']);
                $team->setLogo($teamApi['logo']);

                $stadium->setApiId($stadiumApi['id']);
                $stadium->setName($stadiumApi['name']);
                $stadium->setAddress($stadiumApi['address']);
                $stadium->setCapacity($stadiumApi['capacity']);
                $stadium->setCity($stadiumApi['city']);
                $stadium->setSurface($stadiumApi['surface']);
                $stadium->setImage($stadiumApi['image']);

                $team->setStadium($stadium);

                $this->em->persist($team);
                $this->em->persist($stadium);
            }
        }
        $this->em->flush();
    }
}
