<?php

namespace App\Command;

use App\DataImporter\Football\Game\GameDataImporter;
use App\DataImporter\Football\League\LeagueDataImporter;
use App\DataImporter\Football\Lineup\LineupDataImporter;
use App\DataImporter\Football\Player\PlayerDataImporter;
use App\DataImporter\Football\PlayerStat\PlayerStatDataImporter;
use App\DataImporter\Football\Round\CurrentRoundDataImporter;
use App\DataImporter\Football\Round\RoundDataImporter;
use App\DataImporter\Football\Standing\StandingDataImporter;
use App\DataImporter\Football\Team\TeamDataImporter;
use App\DataImporter\Football\TeamStat\TeamStatDataImporter;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class TestCommand extends Command
{
    protected static $defaultName = 'test:import';

    private RoundDataImporter $roundDataImporter;
    private TeamDataImporter $teamDataImporter;
    private PlayerDataImporter $playerDataImporter;
    private LeagueDataImporter $leagueDataImporter;
    private PlayerStatDataImporter $playerStatDataImporter;
    private StandingDataImporter $standingDataImporter;
    private TeamStatDataImporter $teamStatDataImporter;
    private CurrentRoundDataImporter $currentRoundDataImporter;
    private GameDataImporter $gameDataImporter;
    private LineupDataImporter $lineupDataImporter;

    public function __construct(
        RoundDataImporter $roundDataImporter,
        TeamDataImporter $teamDataImporter,
        PlayerDataImporter $playerDataImporter,
        LeagueDataImporter $leagueDataImporter,
        PlayerStatDataImporter $playerStatDataImporter,
        StandingDataImporter $standingDataImporter,
        TeamStatDataImporter $teamStatDataImporter,
        CurrentRoundDataImporter $currentRoundDataImporter,
        GameDataImporter $gameDataImporter,
        LineupDataImporter $lineupDataImporter,
        string $name = null
    )
    {
        parent::__construct($name);
        $this->roundDataImporter = $roundDataImporter;
        $this->teamDataImporter = $teamDataImporter;
        $this->playerDataImporter = $playerDataImporter;
        $this->leagueDataImporter = $leagueDataImporter;
        $this->playerStatDataImporter = $playerStatDataImporter;
        $this->standingDataImporter = $standingDataImporter;
        $this->teamStatDataImporter = $teamStatDataImporter;
        $this->currentRoundDataImporter = $currentRoundDataImporter;
        $this->gameDataImporter = $gameDataImporter;
        $this->lineupDataImporter = $lineupDataImporter;
    }

    protected function configure(): void
    {
        $this
            ->setDescription('test import data')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        //$this->roundDataImporter->import();
        /*$this->leagueDataImporter->import();
        $this->teamDataImporter->import();
        $this->playerDataImporter->import();*/
        //$this->playerStatDataImporter->import();
        //$this->standingDataImporter->import();
        //$this->teamStatDataImporter->import();
        //$this->currentRoundDataImporter->import();
        //$this->gameDataImporter->import();
        $this->lineupDataImporter->import();

        return 0;
    }
}
