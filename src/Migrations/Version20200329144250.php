<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200329144250 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        $this->addSql('ALTER TABLE vgm add column  exportator_id integer null ');
        $this->addSql('ALTER TABLE vgm ADD CONSTRAINT FK_B6822D75E8493DDD FOREIGN KEY (exportator_id) REFERENCES client (id)');
        $this->addSql('CREATE INDEX IDX_B6822D75E8493DDD ON vgm (exportator_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE vgm DROP FOREIGN KEY FK_B6822D75E8493DDD');
        $this->addSql('DROP INDEX IDX_B6822D75E8493DDD ON vgm');
    }
}
