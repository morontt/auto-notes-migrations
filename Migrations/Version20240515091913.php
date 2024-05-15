<?php

declare(strict_types=1);

namespace AutoNotes\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240515091913 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cars (id INT AUTO_INCREMENT NOT NULL, brand_name VARCHAR(255) DEFAULT NULL, model_name VARCHAR(255) DEFAULT NULL, prod_year INT DEFAULT NULL, vin VARCHAR(17) DEFAULT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, user_id INT NOT NULL, INDEX IDX_95C71D14A76ED395 (user_id), PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE cars ADD CONSTRAINT FK_95C71D14A76ED395 FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE RESTRICT');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cars DROP FOREIGN KEY FK_95C71D14A76ED395');
        $this->addSql('DROP TABLE cars');
    }
}
