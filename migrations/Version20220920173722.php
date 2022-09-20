<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220920173722 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, game_id INT NOT NULL, player_id INT NOT NULL, player_assist_id INT NOT NULL, team_id INT NOT NULL, type VARCHAR(255) NOT NULL, detail VARCHAR(255) NOT NULL, elapsed INT NOT NULL, elapsed_extra INT NOT NULL, INDEX IDX_3BAE0AA7E48FD905 (game_id), INDEX IDX_3BAE0AA799E6F5DF (player_id), INDEX IDX_3BAE0AA71E9607D1 (player_assist_id), INDEX IDX_3BAE0AA7296CD8AE (team_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7E48FD905 FOREIGN KEY (game_id) REFERENCES game (id)');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA799E6F5DF FOREIGN KEY (player_id) REFERENCES player (id)');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA71E9607D1 FOREIGN KEY (player_assist_id) REFERENCES player (id)');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7296CD8AE FOREIGN KEY (team_id) REFERENCES team (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA7E48FD905');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA799E6F5DF');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA71E9607D1');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA7296CD8AE');
        $this->addSql('DROP TABLE event');
    }
}
