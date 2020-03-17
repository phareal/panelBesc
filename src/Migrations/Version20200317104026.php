<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200317104026 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE container (id INT AUTO_INCREMENT NOT NULL, draft_id INT DEFAULT NULL, request_time DATETIME NOT NULL, validation_time DATETIME DEFAULT NULL, net_weight NUMERIC(10, 0) NOT NULL, tare_weight NUMERIC(10, 0) NOT NULL, booking VARCHAR(255) NOT NULL, waybill VARCHAR(255) NOT NULL, consignee VARCHAR(255) NOT NULL, cargo_type VARCHAR(255) NOT NULL, container_size VARCHAR(255) NOT NULL, seal_number VARCHAR(255) NOT NULL, nature_of_goods VARCHAR(255) NOT NULL, company VARCHAR(255) NOT NULL, agreement_number VARCHAR(255) NOT NULL, certifying_officer VARCHAR(255) NOT NULL, validating_officer VARCHAR(255) DEFAULT NULL, weightbridge VARCHAR(255) NOT NULL, transporter VARCHAR(255) DEFAULT NULL, driver VARCHAR(255) DEFAULT NULL, truck_number VARCHAR(255) NOT NULL, company_id INT NOT NULL, tvf_number VARCHAR(255) NOT NULL, tvf_date VARCHAR(255) NOT NULL, weighting_date1 VARCHAR(255) NOT NULL, weighting_date2 DATE NOT NULL, state INT NOT NULL, INDEX IDX_C7A2EC1BE2F3C5D1 (draft_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE draft_container (id INT AUTO_INCREMENT NOT NULL, tare_weight NUMERIC(10, 0) NOT NULL, cargo_type VARCHAR(255) NOT NULL, container_size VARCHAR(255) NOT NULL, company VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE container ADD CONSTRAINT FK_C7A2EC1BE2F3C5D1 FOREIGN KEY (draft_id) REFERENCES draft_container (id)');
        $this->addSql('ALTER TABLE company ADD armateur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094F90161A3C FOREIGN KEY (armateur_id) REFERENCES armateur (id)');
        $this->addSql('CREATE INDEX IDX_4FBF094F90161A3C ON company (armateur_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE container DROP FOREIGN KEY FK_C7A2EC1BE2F3C5D1');
        $this->addSql('DROP TABLE container');
        $this->addSql('DROP TABLE draft_container');
        $this->addSql('ALTER TABLE company DROP FOREIGN KEY FK_4FBF094F90161A3C');
        $this->addSql('DROP INDEX IDX_4FBF094F90161A3C ON company');
        $this->addSql('ALTER TABLE company DROP armateur_id');
    }
}
