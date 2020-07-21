<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200330050306 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE container DROP FOREIGN KEY FK_C7A2EC1BBB5704EA');
        $this->addSql('DROP INDEX IDX_C7A2EC1BBB5704EA ON container');
        $this->addSql('ALTER TABLE container DROP validating_officer_id');
        $this->addSql('ALTER TABLE vgm CHANGE exportator_id exportator_id INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE container ADD validating_officer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE container ADD CONSTRAINT FK_C7A2EC1BBB5704EA FOREIGN KEY (validating_officer_id) REFERENCES admin (id)');
        $this->addSql('CREATE INDEX IDX_C7A2EC1BBB5704EA ON container (validating_officer_id)');
        $this->addSql('ALTER TABLE vgm CHANGE exportator_id exportator_id INT DEFAULT NULL');
    }
}
