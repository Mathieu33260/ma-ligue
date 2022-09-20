<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220920173352 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE team_stat (id INT AUTO_INCREMENT NOT NULL, team_id INT NOT NULL, league_id INT NOT NULL, wins_home INT NOT NULL, wins_away INT NOT NULL, loses_home INT NOT NULL, loses_away INT NOT NULL, draws_home INT NOT NULL, draws_away INT NOT NULL, goals_for_home INT NOT NULL, goals_for_away INT NOT NULL, goals_against_home INT NOT NULL, goals_against_away INT NOT NULL, red_card INT NOT NULL, yellow_card INT NOT NULL, INDEX IDX_F1590B5A296CD8AE (team_id), INDEX IDX_F1590B5A58AFC4DE (league_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE team_stat ADD CONSTRAINT FK_F1590B5A296CD8AE FOREIGN KEY (team_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE team_stat ADD CONSTRAINT FK_F1590B5A58AFC4DE FOREIGN KEY (league_id) REFERENCES league (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE team_stat DROP FOREIGN KEY FK_F1590B5A296CD8AE');
        $this->addSql('ALTER TABLE team_stat DROP FOREIGN KEY FK_F1590B5A58AFC4DE');
        $this->addSql('DROP TABLE team_stat');
    }
}
