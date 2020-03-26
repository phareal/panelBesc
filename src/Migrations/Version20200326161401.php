<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200326161401 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE draft_attachment ADD  vgm_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE draft_attachment ADD CONSTRAINT FK_460AA81017E7D7DE FOREIGN KEY (vgm_id) REFERENCES vgm (id)');
        $this->addSql('CREATE INDEX IDX_460AA81017E7D7DE ON draft_attachment (vgm_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE draft_attachment DROP FOREIGN KEY FK_460AA81017E7D7DE');
        $this->addSql('DROP INDEX IDX_460AA81017E7D7DE ON draft_attachment');
        $this->addSql('ALTER TABLE draft_attachment CHANGE vgm_id container_id INT DEFAULT NULL');
        $this->addSql('CREATE INDEX IDX_460AA810BC21F742 ON draft_attachment (container_id)');
    }
}
