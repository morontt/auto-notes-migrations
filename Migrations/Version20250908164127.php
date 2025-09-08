<?php

declare(strict_types=1);

namespace AutoNotes\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250908164127 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_settings ADD default_fuel_type_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user_settings ADD CONSTRAINT FK_5C844C548A61B9F FOREIGN KEY (default_fuel_type_id) REFERENCES fuel_types (id) ON DELETE RESTRICT');
        $this->addSql('CREATE INDEX IDX_5C844C548A61B9F ON user_settings (default_fuel_type_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_settings DROP FOREIGN KEY FK_5C844C548A61B9F');
        $this->addSql('DROP INDEX IDX_5C844C548A61B9F ON user_settings');
        $this->addSql('ALTER TABLE user_settings DROP default_fuel_type_id');
    }
}
