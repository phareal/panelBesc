<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200326010550 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE attachments (id INT AUTO_INCREMENT NOT NULL, url VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE container ADD certifying_officer_id INT DEFAULT NULL, ADD validating_officer_id INT DEFAULT NULL, DROP tare_weight, DROP cargo_type, DROP container_size, DROP nature_of_goods, DROP company, DROP certifying_officer, DROP validating_officer, DROP company_id, CHANGE consignee consignee VARCHAR(255) DEFAULT NULL, CHANGE seal_number seal_number VARCHAR(255) DEFAULT NULL, CHANGE agreement_number agreement_number VARCHAR(255) DEFAULT NULL, CHANGE truck_number truck_number VARCHAR(255) DEFAULT NULL, CHANGE tvf_number tvf_number VARCHAR(255) DEFAULT NULL, CHANGE tvf_date tvf_date VARCHAR(255) DEFAULT NULL, CHANGE weighting_date1 weighting_date1 DATE DEFAULT NULL, CHANGE weighting_date2 weighting_date2 DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE container ADD CONSTRAINT FK_C7A2EC1B7A03ED7E FOREIGN KEY (certifying_officer_id) REFERENCES admin (id)');
        $this->addSql('ALTER TABLE container ADD CONSTRAINT FK_C7A2EC1BBB5704EA FOREIGN KEY (validating_officer_id) REFERENCES admin (id)');
        $this->addSql('CREATE INDEX IDX_C7A2EC1B7A03ED7E ON container (certifying_officer_id)');
        $this->addSql('CREATE INDEX IDX_C7A2EC1BBB5704EA ON container (validating_officer_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE attachments');
        $this->addSql('ALTER TABLE container DROP FOREIGN KEY FK_C7A2EC1B7A03ED7E');
        $this->addSql('ALTER TABLE container DROP FOREIGN KEY FK_C7A2EC1BBB5704EA');
        $this->addSql('DROP INDEX IDX_C7A2EC1B7A03ED7E ON container');
        $this->addSql('DROP INDEX IDX_C7A2EC1BBB5704EA ON container');
        $this->addSql('ALTER TABLE container ADD tare_weight NUMERIC(10, 0) NOT NULL, ADD cargo_type VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD container_size VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD nature_of_goods VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD company VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD certifying_officer VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD validating_officer VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD company_id INT NOT NULL, DROP certifying_officer_id, DROP validating_officer_id, CHANGE consignee consignee VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE seal_number seal_number VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE agreement_number agreement_number VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE truck_number truck_number VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE tvf_number tvf_number VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE tvf_date tvf_date VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE weighting_date1 weighting_date1 VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE weighting_date2 weighting_date2 DATE NOT NULL');
    }
}
