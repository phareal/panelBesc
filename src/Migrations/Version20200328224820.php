<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200328224820 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE client_role (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE container CHANGE request_time request_time DATETIME NOT NULL, CHANGE net_weight net_weight NUMERIC(10, 0) NOT NULL, CHANGE booking booking VARCHAR(255) NOT NULL, CHANGE waybill waybill VARCHAR(255) NOT NULL, CHANGE weightbridge weightbridge VARCHAR(255) NOT NULL, CHANGE company company VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE client ADD client_role_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455843E66D1 FOREIGN KEY (client_role_id) REFERENCES client_role (id)');
        $this->addSql('CREATE INDEX IDX_C7440455843E66D1 ON client (client_role_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C7440455843E66D1');
        $this->addSql('DROP TABLE client_role');
        $this->addSql('DROP INDEX IDX_C7440455843E66D1 ON client');
        $this->addSql('ALTER TABLE client DROP client_role_id');
        $this->addSql('ALTER TABLE container CHANGE request_time request_time DATETIME DEFAULT NULL, CHANGE net_weight net_weight NUMERIC(10, 0) DEFAULT NULL, CHANGE booking booking VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE waybill waybill VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE weightbridge weightbridge VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE company company VARCHAR(8) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
