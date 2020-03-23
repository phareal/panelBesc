<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200323153046 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE other_admin (id INT AUTO_INCREMENT NOT NULL, admin_id INT NOT NULL, role_id INT NOT NULL, module_id INT DEFAULT NULL, INDEX IDX_E0BAFAD8642B8210 (admin_id), INDEX IDX_E0BAFAD8D60322AC (role_id), INDEX IDX_E0BAFAD8AFC2B591 (module_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE other_admin ADD CONSTRAINT FK_E0BAFAD8642B8210 FOREIGN KEY (admin_id) REFERENCES admin (id)');
        $this->addSql('ALTER TABLE other_admin ADD CONSTRAINT FK_E0BAFAD8D60322AC FOREIGN KEY (role_id) REFERENCES role (id)');
        $this->addSql('ALTER TABLE other_admin ADD CONSTRAINT FK_E0BAFAD8AFC2B591 FOREIGN KEY (module_id) REFERENCES module (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_27D59ABDF356DA43 ON draft_container (proprietaire_code)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE other_admin');
        $this->addSql('DROP INDEX UNIQ_27D59ABDF356DA43 ON draft_container');
    }
}
