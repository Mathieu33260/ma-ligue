<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220920172211 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE player_position (id INT AUTO_INCREMENT NOT NULL, player_id INT NOT NULL, lineup_id INT NOT NULL, number INT NOT NULL, position VARCHAR(255) NOT NULL, grid VARCHAR(255) NOT NULL, is_starter TINYINT(1) NOT NULL, INDEX IDX_40FBA51599E6F5DF (player_id), INDEX IDX_40FBA515D347A7DE (lineup_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE player_position ADD CONSTRAINT FK_40FBA51599E6F5DF FOREIGN KEY (player_id) REFERENCES player (id)');
        $this->addSql('ALTER TABLE player_position ADD CONSTRAINT FK_40FBA515D347A7DE FOREIGN KEY (lineup_id) REFERENCES lineup (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE player_position DROP FOREIGN KEY FK_40FBA51599E6F5DF');
        $this->addSql('ALTER TABLE player_position DROP FOREIGN KEY FK_40FBA515D347A7DE');
        $this->addSql('DROP TABLE player_position');
    }
}
