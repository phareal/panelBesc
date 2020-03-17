<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200317152605 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE company');
        $this->addSql('ALTER TABLE armateur ADD state INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE company (id INT AUTO_INCREMENT NOT NULL, armateur_id INT DEFAULT NULL, client_id INT DEFAULT NULL, INDEX IDX_4FBF094F19EB6921 (client_id), INDEX IDX_4FBF094F90161A3C (armateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094F19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094F90161A3C FOREIGN KEY (armateur_id) REFERENCES armateur (id)');
        $this->addSql('ALTER TABLE armateur DROP state');
    }
}
