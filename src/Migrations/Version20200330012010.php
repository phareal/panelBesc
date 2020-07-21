<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200330012010 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE points_purchase (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, seller_id INT DEFAULT NULL, buy_point INT NOT NULL, buy_at DATETIME NOT NULL, INDEX IDX_B998122B19EB6921 (client_id), INDEX IDX_B998122B8DE820D9 (seller_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE points_purchase ADD CONSTRAINT FK_B998122B19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE points_purchase ADD CONSTRAINT FK_B998122B8DE820D9 FOREIGN KEY (seller_id) REFERENCES admin (id)');
        $this->addSql('ALTER TABLE client ADD solde INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE points_purchase');
        $this->addSql('ALTER TABLE client DROP solde');
        $this->addSql('ALTER TABLE vgm CHANGE exportator_id exportator_id INT DEFAULT NULL');
    }
}
