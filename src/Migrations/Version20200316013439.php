<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200316013439 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE if not exists port (id INT AUTO_INCREMENT NOT NULL, country_id INT DEFAULT NULL, label VARCHAR(255) NOT NULL, INDEX IDX_43915DCCF92F3E70 (country_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE if not exists port_consignataire (port_id INT NOT NULL, consignataire_id INT NOT NULL, INDEX IDX_929E723376E92A9C (port_id), INDEX IDX_929E7233DE1464AE (consignataire_id), PRIMARY KEY(port_id, consignataire_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE if not exists ship (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE if not exists conteneur (id INT AUTO_INCREMENT NOT NULL, request_time DATETIME NOT NULL, validation_time DATETIME DEFAULT NULL, net_weight NUMERIC(10, 0) NOT NULL, tare_weight NUMERIC(10, 0) NOT NULL, booking VARCHAR(255) NOT NULL, waybill VARCHAR(255) NOT NULL, consignee VARCHAR(255) NOT NULL, cargo_type VARCHAR(255) NOT NULL, container_size VARCHAR(255) NOT NULL, seal_number VARCHAR(255) NOT NULL, nature_of_goods VARCHAR(255) NOT NULL, company VARCHAR(255) NOT NULL, agreement_number VARCHAR(255) NOT NULL, certifying_officer VARCHAR(255) NOT NULL, validating_officer VARCHAR(255) DEFAULT NULL, weightbridge VARCHAR(255) NOT NULL, transporter VARCHAR(255) DEFAULT NULL, driver VARCHAR(255) DEFAULT NULL, truck_number VARCHAR(255) NOT NULL, company_id INT NOT NULL, tvf_number VARCHAR(255) NOT NULL, tvf_date VARCHAR(255) NOT NULL, weighting_date1 VARCHAR(255) NOT NULL, weighting_date2 DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE if not exists country (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE if not exists company (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE port ADD CONSTRAINT FK_43915DCCF92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE port_consignataire ADD CONSTRAINT FK_929E723376E92A9C FOREIGN KEY (port_id) REFERENCES port (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE port_consignataire ADD CONSTRAINT FK_929E7233DE1464AE FOREIGN KEY (consignataire_id) REFERENCES consignataire (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE port_consignataire DROP FOREIGN KEY FK_929E723376E92A9C');
        $this->addSql('ALTER TABLE port DROP FOREIGN KEY FK_43915DCCF92F3E70');
        $this->addSql('DROP TABLE port');
        $this->addSql('DROP TABLE port_consignataire');
        $this->addSql('DROP TABLE ship');
        $this->addSql('DROP TABLE conteneur');
        $this->addSql('DROP TABLE country');
        $this->addSql('DROP TABLE company');
    }
}
