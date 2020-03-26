<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200325031015 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE if not exists container_type (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE draft_container CHANGE container_type_id container_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE draft_container ADD CONSTRAINT FK_27D59ABDBC21F742 FOREIGN KEY (container_id) REFERENCES container_type (id)');
        $this->addSql('CREATE INDEX IDX_27D59ABDBC21F742 ON draft_container (container_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE draft_container DROP FOREIGN KEY FK_27D59ABDBC21F742');
        $this->addSql('DROP TABLE container_type');
        $this->addSql('DROP INDEX IDX_27D59ABDBC21F742 ON draft_container');
        $this->addSql('ALTER TABLE draft_container CHANGE container_id container_type_id INT DEFAULT NULL');
    }
}
