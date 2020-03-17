<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200317040357 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE draft_container (id INT AUTO_INCREMENT NOT NULL, net_weight NUMERIC(10, 0) NOT NULL, cargo_type VARCHAR(255) NOT NULL, container_size VARCHAR(255) NOT NULL, company VARCHAR(255) NOT NULL, agreement_number VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE conteneur ADD draft_id INT DEFAULT NULL, ADD state INT NOT NULL');
        $this->addSql('ALTER TABLE conteneur ADD CONSTRAINT FK_E9628FD2E2F3C5D1 FOREIGN KEY (draft_id) REFERENCES draft_container (id)');
        $this->addSql('CREATE INDEX IDX_E9628FD2E2F3C5D1 ON conteneur (draft_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE conteneur DROP FOREIGN KEY FK_E9628FD2E2F3C5D1');
        $this->addSql('DROP TABLE draft_container');
        $this->addSql('DROP INDEX IDX_E9628FD2E2F3C5D1 ON conteneur');
        $this->addSql('ALTER TABLE conteneur DROP draft_id, DROP state');
    }
}
