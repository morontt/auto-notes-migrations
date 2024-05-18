<?php

declare(strict_types=1);

namespace AutoNotes\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240518170144 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE orders (id INT AUTO_INCREMENT NOT NULL, description VARCHAR(255) NOT NULL, capacity VARCHAR(255) DEFAULT NULL, date DATE NOT NULL, used_at DATE DEFAULT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, cost NUMERIC(8, 2) NOT NULL, user_id INT NOT NULL, mileage_id INT DEFAULT NULL, type_id INT DEFAULT NULL, currency_id INT NOT NULL, INDEX IDX_E52FFDEEA76ED395 (user_id), INDEX IDX_E52FFDEE14DB6A4E (mileage_id), INDEX IDX_E52FFDEEC54C8C93 (type_id), INDEX IDX_E52FFDEE38248176 (currency_id), PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEEA76ED395 FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE RESTRICT');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEE14DB6A4E FOREIGN KEY (mileage_id) REFERENCES mileages (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEEC54C8C93 FOREIGN KEY (type_id) REFERENCES order_types (id) ON DELETE RESTRICT');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEE38248176 FOREIGN KEY (currency_id) REFERENCES currencies (id) ON DELETE RESTRICT');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E52FFDEEA76ED395');
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E52FFDEE14DB6A4E');
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E52FFDEEC54C8C93');
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E52FFDEE38248176');
        $this->addSql('DROP TABLE orders');
    }
}
