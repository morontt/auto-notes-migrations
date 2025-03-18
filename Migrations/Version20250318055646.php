<?php

declare(strict_types=1);

namespace AutoNotes\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250318055646 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cars CHANGE updated_at updated_at DATETIME DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP');
        $this->addSql('ALTER TABLE user_settings CHANGE updated_at updated_at DATETIME DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP');
        $this->addSql('ALTER TABLE users CHANGE updated_at updated_at DATETIME DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cars CHANGE updated_at updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE users CHANGE updated_at updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE user_settings CHANGE updated_at updated_at DATETIME DEFAULT NULL');
    }
}
