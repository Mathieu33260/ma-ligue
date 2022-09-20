<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220920172318 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE round ADD league_id INT NOT NULL');
        $this->addSql('ALTER TABLE round ADD CONSTRAINT FK_C5EEEA3458AFC4DE FOREIGN KEY (league_id) REFERENCES league (id)');
        $this->addSql('CREATE INDEX IDX_C5EEEA3458AFC4DE ON round (league_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE round DROP FOREIGN KEY FK_C5EEEA3458AFC4DE');
        $this->addSql('DROP INDEX IDX_C5EEEA3458AFC4DE ON round');
        $this->addSql('ALTER TABLE round DROP league_id');
    }
}
