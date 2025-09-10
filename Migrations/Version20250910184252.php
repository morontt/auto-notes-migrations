<?php

declare(strict_types=1);

namespace AutoNotes\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250910184252 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE expenses ADD updated_at DATETIME DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP');
        $this->addSql('ALTER TABLE fuels ADD updated_at DATETIME DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP');
        $this->addSql('ALTER TABLE orders ADD updated_at DATETIME DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE orders DROP updated_at');
        $this->addSql('ALTER TABLE fuels DROP updated_at');
        $this->addSql('ALTER TABLE expenses DROP updated_at');
    }
}
