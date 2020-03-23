<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200320131940 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE cargo_type (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE draft_container ADD cargo_type_id INT DEFAULT NULL, DROP cargo_type');
        $this->addSql('ALTER TABLE draft_container ADD CONSTRAINT FK_27D59ABDCD33D8BC FOREIGN KEY (cargo_type_id) REFERENCES cargo_type (id)');
        $this->addSql('CREATE INDEX IDX_27D59ABDCD33D8BC ON draft_container (cargo_type_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE draft_container DROP FOREIGN KEY FK_27D59ABDCD33D8BC');
        $this->addSql('DROP TABLE cargo_type');
        $this->addSql('DROP INDEX IDX_27D59ABDCD33D8BC ON draft_container');
        $this->addSql('ALTER TABLE draft_container ADD cargo_type VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP cargo_type_id');
    }
}
