<?php

declare(strict_types=1);

namespace AutoNotes\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250826194035 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE fuel_types (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(16) NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE fuels ADD type_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE fuels ADD CONSTRAINT FK_C2E928B8C54C8C93 FOREIGN KEY (type_id) REFERENCES fuel_types (id)');
        $this->addSql('CREATE INDEX IDX_C2E928B8C54C8C93 ON fuels (type_id)');

        $this->addSql('INSERT INTO fuel_types (`name`) VALUES (\'ДТ\'), (\'АИ-92\'), (\'АИ-95\'), (\'АИ-98\')');
        $this->addSql("UPDATE fuels AS f, fuel_types AS ft SET f.type_id = ft.id WHERE ft.name = 'ДТ'");
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fuels DROP FOREIGN KEY FK_C2E928B8C54C8C93');
        $this->addSql('DROP INDEX IDX_C2E928B8C54C8C93 ON fuels');
        $this->addSql('ALTER TABLE fuels DROP type_id');
        $this->addSql('DROP TABLE fuel_types');
    }
}
