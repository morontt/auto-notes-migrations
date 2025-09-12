<?php

declare(strict_types=1);

namespace AutoNotes\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250912205403 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE relation_services_orders (service_id INT NOT NULL, order_id INT NOT NULL, INDEX IDX_E1EF2BF0ED5CA9E6 (service_id), INDEX IDX_E1EF2BF08D9F6D38 (order_id), PRIMARY KEY(service_id, order_id))');
        $this->addSql('ALTER TABLE relation_services_orders ADD CONSTRAINT FK_E1EF2BF0ED5CA9E6 FOREIGN KEY (service_id) REFERENCES services (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE relation_services_orders ADD CONSTRAINT FK_E1EF2BF08D9F6D38 FOREIGN KEY (order_id) REFERENCES orders (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE expenses ADD car_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE expenses ADD CONSTRAINT FK_2496F35BC3C6F69F FOREIGN KEY (car_id) REFERENCES cars (id) ON DELETE RESTRICT');
        $this->addSql('CREATE INDEX IDX_2496F35BC3C6F69F ON expenses (car_id)');
        $this->addSql('ALTER TABLE orders ADD car_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEEC3C6F69F FOREIGN KEY (car_id) REFERENCES cars (id) ON DELETE RESTRICT');
        $this->addSql('CREATE INDEX IDX_E52FFDEEC3C6F69F ON orders (car_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE relation_services_orders DROP FOREIGN KEY FK_E1EF2BF0ED5CA9E6');
        $this->addSql('ALTER TABLE relation_services_orders DROP FOREIGN KEY FK_E1EF2BF08D9F6D38');
        $this->addSql('DROP TABLE relation_services_orders');
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E52FFDEEC3C6F69F');
        $this->addSql('DROP INDEX IDX_E52FFDEEC3C6F69F ON orders');
        $this->addSql('ALTER TABLE orders DROP car_id');
        $this->addSql('ALTER TABLE expenses DROP FOREIGN KEY FK_2496F35BC3C6F69F');
        $this->addSql('DROP INDEX IDX_2496F35BC3C6F69F ON expenses');
        $this->addSql('ALTER TABLE expenses DROP car_id');
    }
}
