<?php

declare(strict_types=1);

namespace AutoNotes\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251214064322 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fuel_types ADD parent_id INT DEFAULT NULL AFTER `name`');
        $this->addSql('ALTER TABLE fuel_types ADD CONSTRAINT FK_3390D69A727ACA70 FOREIGN KEY (parent_id) REFERENCES fuel_types (id) ON DELETE RESTRICT');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3390D69A5E237E06 ON fuel_types (name)');
        $this->addSql('CREATE INDEX IDX_3390D69A727ACA70 ON fuel_types (parent_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fuel_types DROP FOREIGN KEY FK_3390D69A727ACA70');
        $this->addSql('DROP INDEX UNIQ_3390D69A5E237E06 ON fuel_types');
        $this->addSql('DROP INDEX IDX_3390D69A727ACA70 ON fuel_types');
        $this->addSql('ALTER TABLE fuel_types DROP parent_id');
    }
}
