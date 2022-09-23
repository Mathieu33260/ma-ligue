<?php

namespace App\DataImporter\Football\Round;

use App\DataImporter\Football\FootballImporter;

class RoundDataImporter extends FootballImporter
{
    public function import(): void
    {
        $params = [
            'league' => 61,
            'season' => 2022,
        ];
        $responses = $this->client->request('/fixtures/rounds', $params);
    }
}
