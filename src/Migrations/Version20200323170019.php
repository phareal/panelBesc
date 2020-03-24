<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200323170019 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE UNIQUE INDEX UNIQ_27D59ABDF356DA43 ON draft_container (proprietaire_code)');
        $this->addSql('ALTER TABLE other_admin DROP FOREIGN KEY FK_E0BAFAD8AFC2B591');
        $this->addSql('ALTER TABLE other_admin DROP FOREIGN KEY FK_E0BAFAD8D60322AC');
        $this->addSql('DROP INDEX IDX_E0BAFAD8D60322AC ON other_admin');
        $this->addSql('DROP INDEX IDX_E0BAFAD8AFC2B591 ON other_admin');
        $this->addSql('ALTER TABLE other_admin DROP role_id, DROP module_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX UNIQ_27D59ABDF356DA43 ON draft_container');
        $this->addSql('ALTER TABLE other_admin ADD role_id INT NOT NULL, ADD module_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE other_admin ADD CONSTRAINT FK_E0BAFAD8AFC2B591 FOREIGN KEY (module_id) REFERENCES module (id)');
        $this->addSql('ALTER TABLE other_admin ADD CONSTRAINT FK_E0BAFAD8D60322AC FOREIGN KEY (role_id) REFERENCES role (id)');
        $this->addSql('CREATE INDEX IDX_E0BAFAD8D60322AC ON other_admin (role_id)');
        $this->addSql('CREATE INDEX IDX_E0BAFAD8AFC2B591 ON other_admin (module_id)');
    }
}
