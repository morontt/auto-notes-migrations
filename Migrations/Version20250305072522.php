<?php

declare(strict_types=1);

namespace AutoNotes\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250305072522 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_182A68EAA9E377A565088D0C3C6F69F ON mileages');
        $this->addSql('ALTER TABLE mileages CHANGE distanse distance INT NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_182A68EAA9E377A1C929A81C3C6F69F ON mileages (date, distance, car_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_182A68EAA9E377A1C929A81C3C6F69F ON mileages');
        $this->addSql('ALTER TABLE mileages CHANGE distance distanse INT NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_182A68EAA9E377A565088D0C3C6F69F ON mileages (date, distanse, car_id)');
    }
}
