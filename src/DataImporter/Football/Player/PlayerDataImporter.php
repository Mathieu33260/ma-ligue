<?php

namespace App\DataImporter\Football\Player;

use App\DataImporter\Football\FootballImporter;
use App\Entity\Player;
use App\Entity\Team;

class PlayerDataImporter extends FootballImporter
{
    public function import(): void
    {
        $teams = $this->em->getRepository(Team::class)->findAll();

        foreach ($teams as $team) {
            $responses = $this->client->request('/players/squads', ['team' => $team->getApiId()]);

            $playersApi = $responses['response'][0]['players'];
            foreach ($playersApi as $playerApi) {
                $existingPlayer = $this->em->getRepository(Player::class)->findOneBy(['apiId' => $playerApi['id']]);

                $player = $existingPlayer ?? new Player();
                $player->setApiId($playerApi['id']);
                $player->setName($playerApi['name']);
                $player->setAge($playerApi['age']);
                $player->setNumber($playerApi['number']);
                $player->setPosition($playerApi['position']);
                $player->setPhoto($playerApi['photo']);

                $player->setTeam($team);
                $team->addPlayer($player);

                $this->em->persist($player);
                $this->em->persist($team);
            }
        }

        $this->em->flush();
    }
}
