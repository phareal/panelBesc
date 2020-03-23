<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200317170706 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE draft_container ADD armateur_id INT DEFAULT NULL, DROP company');
        $this->addSql('ALTER TABLE draft_container ADD CONSTRAINT FK_27D59ABD90161A3C FOREIGN KEY (armateur_id) REFERENCES armateur (id)');
        $this->addSql('CREATE INDEX IDX_27D59ABD90161A3C ON draft_container (armateur_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE draft_container DROP FOREIGN KEY FK_27D59ABD90161A3C');
        $this->addSql('DROP INDEX IDX_27D59ABD90161A3C ON draft_container');
        $this->addSql('ALTER TABLE draft_container ADD company VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP armateur_id');
    }
}
