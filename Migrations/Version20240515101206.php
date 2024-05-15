<?php

declare(strict_types=1);

namespace AutoNotes\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240515101206 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE currencies (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(32) NOT NULL, code VARCHAR(3) NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, UNIQUE INDEX UNIQ_37C4469377153098 (code), PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE filling_stations (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(32) NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, UNIQUE INDEX UNIQ_6B1A50925E237E06 (name), PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE fuels (id INT AUTO_INCREMENT NOT NULL, cost NUMERIC(8, 2) NOT NULL, date DATE NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, currency_id INT NOT NULL, station_id INT NOT NULL, car_id INT DEFAULT NULL, INDEX IDX_C2E928B838248176 (currency_id), INDEX IDX_C2E928B821BDB235 (station_id), INDEX IDX_C2E928B8C3C6F69F (car_id), PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE fuels ADD CONSTRAINT FK_C2E928B838248176 FOREIGN KEY (currency_id) REFERENCES currencies (id) ON DELETE RESTRICT');
        $this->addSql('ALTER TABLE fuels ADD CONSTRAINT FK_C2E928B821BDB235 FOREIGN KEY (station_id) REFERENCES filling_stations (id) ON DELETE RESTRICT');
        $this->addSql('ALTER TABLE fuels ADD CONSTRAINT FK_C2E928B8C3C6F69F FOREIGN KEY (car_id) REFERENCES cars (id) ON DELETE RESTRICT');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fuels DROP FOREIGN KEY FK_C2E928B838248176');
        $this->addSql('ALTER TABLE fuels DROP FOREIGN KEY FK_C2E928B821BDB235');
        $this->addSql('ALTER TABLE fuels DROP FOREIGN KEY FK_C2E928B8C3C6F69F');
        $this->addSql('DROP TABLE currencies');
        $this->addSql('DROP TABLE filling_stations');
        $this->addSql('DROP TABLE fuels');
    }
}
