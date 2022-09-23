<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220923125707 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE player_stat ADD team_id INT NOT NULL');
        $this->addSql('ALTER TABLE player_stat ADD CONSTRAINT FK_82A2AF12296CD8AE FOREIGN KEY (team_id) REFERENCES team (id)');
        $this->addSql('CREATE INDEX IDX_82A2AF12296CD8AE ON player_stat (team_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE player_stat DROP FOREIGN KEY FK_82A2AF12296CD8AE');
        $this->addSql('DROP INDEX IDX_82A2AF12296CD8AE ON player_stat');
        $this->addSql('ALTER TABLE player_stat DROP team_id');
    }
}
