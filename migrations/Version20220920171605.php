<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220920171605 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE game (id INT AUTO_INCREMENT NOT NULL, stadium_id INT NOT NULL, league_id INT NOT NULL, hometeam_id INT NOT NULL, awayteam_id INT NOT NULL, round_id INT NOT NULL, api_id INT NOT NULL, date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', status VARCHAR(255) NOT NULL, elapsed INT NOT NULL, referee VARCHAR(255) NOT NULL, goals_hometeam INT NOT NULL, goals_awayteam INT NOT NULL, INDEX IDX_232B318C7E860E36 (stadium_id), INDEX IDX_232B318C58AFC4DE (league_id), INDEX IDX_232B318C205B5690 (hometeam_id), INDEX IDX_232B318CA24F7E79 (awayteam_id), INDEX IDX_232B318CA6005CA0 (round_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C7E860E36 FOREIGN KEY (stadium_id) REFERENCES stadium (id)');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C58AFC4DE FOREIGN KEY (league_id) REFERENCES league (id)');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C205B5690 FOREIGN KEY (hometeam_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318CA24F7E79 FOREIGN KEY (awayteam_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318CA6005CA0 FOREIGN KEY (round_id) REFERENCES round (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318C7E860E36');
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318C58AFC4DE');
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318C205B5690');
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318CA24F7E79');
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318CA6005CA0');
        $this->addSql('DROP TABLE game');
    }
}
