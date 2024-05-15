<?php

declare(strict_types=1);

namespace AutoNotes\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240515122437 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE expenses (id INT AUTO_INCREMENT NOT NULL, type SMALLINT NOT NULL, description VARCHAR(255) NOT NULL, date DATE NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, cost NUMERIC(8, 2) NOT NULL, user_id INT NOT NULL, currency_id INT NOT NULL, INDEX IDX_2496F35BA76ED395 (user_id), INDEX IDX_2496F35B38248176 (currency_id), PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE mileages (id INT AUTO_INCREMENT NOT NULL, date DATE NOT NULL, distanse INT NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, car_id INT NOT NULL, INDEX IDX_182A68EC3C6F69F (car_id), PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE expenses ADD CONSTRAINT FK_2496F35BA76ED395 FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE RESTRICT');
        $this->addSql('ALTER TABLE expenses ADD CONSTRAINT FK_2496F35B38248176 FOREIGN KEY (currency_id) REFERENCES currencies (id) ON DELETE RESTRICT');
        $this->addSql('ALTER TABLE mileages ADD CONSTRAINT FK_182A68EC3C6F69F FOREIGN KEY (car_id) REFERENCES cars (id) ON DELETE RESTRICT');
        $this->addSql('ALTER TABLE fuels ADD mileage_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE fuels ADD CONSTRAINT FK_C2E928B814DB6A4E FOREIGN KEY (mileage_id) REFERENCES mileages (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_C2E928B814DB6A4E ON fuels (mileage_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE expenses DROP FOREIGN KEY FK_2496F35BA76ED395');
        $this->addSql('ALTER TABLE expenses DROP FOREIGN KEY FK_2496F35B38248176');
        $this->addSql('ALTER TABLE mileages DROP FOREIGN KEY FK_182A68EC3C6F69F');
        $this->addSql('DROP TABLE expenses');
        $this->addSql('DROP TABLE mileages');
        $this->addSql('ALTER TABLE fuels DROP FOREIGN KEY FK_C2E928B814DB6A4E');
        $this->addSql('DROP INDEX IDX_C2E928B814DB6A4E ON fuels');
        $this->addSql('ALTER TABLE fuels DROP mileage_id');
    }
}
