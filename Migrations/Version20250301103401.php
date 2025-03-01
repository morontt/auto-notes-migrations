<?php

declare(strict_types=1);

namespace AutoNotes\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250301103401 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_settings (id INT AUTO_INCREMENT NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at DATETIME DEFAULT NULL, user_id INT NOT NULL, default_car_id INT DEFAULT NULL, default_currency_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_5C844C5A76ED395 (user_id), INDEX IDX_5C844C52497FDCC (default_car_id), INDEX IDX_5C844C5ECD792C0 (default_currency_id), PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE user_settings ADD CONSTRAINT FK_5C844C5A76ED395 FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_settings ADD CONSTRAINT FK_5C844C52497FDCC FOREIGN KEY (default_car_id) REFERENCES cars (id) ON DELETE RESTRICT');
        $this->addSql('ALTER TABLE user_settings ADD CONSTRAINT FK_5C844C5ECD792C0 FOREIGN KEY (default_currency_id) REFERENCES currencies (id) ON DELETE RESTRICT');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_settings DROP FOREIGN KEY FK_5C844C5A76ED395');
        $this->addSql('ALTER TABLE user_settings DROP FOREIGN KEY FK_5C844C52497FDCC');
        $this->addSql('ALTER TABLE user_settings DROP FOREIGN KEY FK_5C844C5ECD792C0');
        $this->addSql('DROP TABLE user_settings');
    }
}
