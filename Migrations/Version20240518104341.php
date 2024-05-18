<?php

declare(strict_types=1);

namespace AutoNotes\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240518104341 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE services (id INT AUTO_INCREMENT NOT NULL, cost NUMERIC(8, 2) DEFAULT NULL, description VARCHAR(255) NOT NULL, date DATE NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, currency_id INT DEFAULT NULL, car_id INT NOT NULL, mileage_id INT DEFAULT NULL, INDEX IDX_7332E16938248176 (currency_id), INDEX IDX_7332E169C3C6F69F (car_id), INDEX IDX_7332E16914DB6A4E (mileage_id), PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE services ADD CONSTRAINT FK_7332E16938248176 FOREIGN KEY (currency_id) REFERENCES currencies (id) ON DELETE RESTRICT');
        $this->addSql('ALTER TABLE services ADD CONSTRAINT FK_7332E169C3C6F69F FOREIGN KEY (car_id) REFERENCES cars (id) ON DELETE RESTRICT');
        $this->addSql('ALTER TABLE services ADD CONSTRAINT FK_7332E16914DB6A4E FOREIGN KEY (mileage_id) REFERENCES mileages (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE fuels DROP FOREIGN KEY FK_C2E928B814DB6A4E');
        $this->addSql('ALTER TABLE fuels ADD CONSTRAINT FK_C2E928B814DB6A4E FOREIGN KEY (mileage_id) REFERENCES mileages (id) ON DELETE SET NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE services DROP FOREIGN KEY FK_7332E16938248176');
        $this->addSql('ALTER TABLE services DROP FOREIGN KEY FK_7332E169C3C6F69F');
        $this->addSql('ALTER TABLE services DROP FOREIGN KEY FK_7332E16914DB6A4E');
        $this->addSql('DROP TABLE services');
        $this->addSql('ALTER TABLE fuels DROP FOREIGN KEY FK_C2E928B814DB6A4E');
        $this->addSql('ALTER TABLE fuels ADD CONSTRAINT FK_C2E928B814DB6A4E FOREIGN KEY (mileage_id) REFERENCES mileages (id) ON UPDATE NO ACTION ON DELETE CASCADE');
    }
}
