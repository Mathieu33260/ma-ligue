<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220920165804 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE player_stat (id INT AUTO_INCREMENT NOT NULL, player_id INT NOT NULL, goals INT NOT NULL, goals_assists INT NOT NULL, goals_conceded INT NOT NULL, passes INT NOT NULL, passes_accuracy INT NOT NULL, shots INT NOT NULL, shots_on INT NOT NULL, card_yellow INT NOT NULL, card_red INT NOT NULL, games INT NOT NULL, titu INT NOT NULL, penalty_on INT NOT NULL, penalty_out INT NOT NULL, minutes_played INT NOT NULL, INDEX IDX_82A2AF1299E6F5DF (player_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE player_stat ADD CONSTRAINT FK_82A2AF1299E6F5DF FOREIGN KEY (player_id) REFERENCES player (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE player_stat DROP FOREIGN KEY FK_82A2AF1299E6F5DF');
        $this->addSql('DROP TABLE player_stat');
    }
}
