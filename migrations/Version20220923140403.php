<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220923140403 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE player_stat CHANGE goals goals INT DEFAULT NULL, CHANGE goals_assists goals_assists INT DEFAULT NULL, CHANGE goals_conceded goals_conceded INT DEFAULT NULL, CHANGE passes passes INT DEFAULT NULL, CHANGE passes_accuracy passes_accuracy INT DEFAULT NULL, CHANGE shots shots INT DEFAULT NULL, CHANGE shots_on shots_on INT DEFAULT NULL, CHANGE card_yellow card_yellow INT DEFAULT NULL, CHANGE card_red card_red INT DEFAULT NULL, CHANGE games games INT DEFAULT NULL, CHANGE titu titu INT DEFAULT NULL, CHANGE penalty_on penalty_on INT DEFAULT NULL, CHANGE penalty_out penalty_out INT DEFAULT NULL, CHANGE minutes_played minutes_played INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE player_stat CHANGE goals goals INT NOT NULL, CHANGE goals_assists goals_assists INT NOT NULL, CHANGE goals_conceded goals_conceded INT NOT NULL, CHANGE passes passes INT NOT NULL, CHANGE passes_accuracy passes_accuracy INT NOT NULL, CHANGE shots shots INT NOT NULL, CHANGE shots_on shots_on INT NOT NULL, CHANGE card_yellow card_yellow INT NOT NULL, CHANGE card_red card_red INT NOT NULL, CHANGE games games INT NOT NULL, CHANGE titu titu INT NOT NULL, CHANGE penalty_on penalty_on INT NOT NULL, CHANGE penalty_out penalty_out INT NOT NULL, CHANGE minutes_played minutes_played INT NOT NULL');
    }
}
