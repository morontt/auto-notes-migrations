<?php

declare(strict_types=1);

namespace AutoNotes\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250906072615 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fuels ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE fuels ADD CONSTRAINT FK_C2E928B8A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_C2E928B8A76ED395 ON fuels (user_id)');

        $this->addSql('UPDATE fuels AS f SET f.user_id = 1');
        $this->addSql('ALTER TABLE fuels CHANGE user_id user_id INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fuels DROP FOREIGN KEY FK_C2E928B8A76ED395');
        $this->addSql('DROP INDEX IDX_C2E928B8A76ED395 ON fuels');
        $this->addSql('ALTER TABLE fuels DROP user_id');
    }
}
