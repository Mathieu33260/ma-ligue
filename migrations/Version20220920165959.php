<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220920165959 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE player_stat ADD league_id INT NOT NULL');
        $this->addSql('ALTER TABLE player_stat ADD CONSTRAINT FK_82A2AF1258AFC4DE FOREIGN KEY (league_id) REFERENCES league (id)');
        $this->addSql('CREATE INDEX IDX_82A2AF1258AFC4DE ON player_stat (league_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE player_stat DROP FOREIGN KEY FK_82A2AF1258AFC4DE');
        $this->addSql('DROP INDEX IDX_82A2AF1258AFC4DE ON player_stat');
        $this->addSql('ALTER TABLE player_stat DROP league_id');
    }
}
