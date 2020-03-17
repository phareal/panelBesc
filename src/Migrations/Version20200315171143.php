<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200315171143 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE consignataire (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, INDEX IDX_23875DB119EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE armateur (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, INDEX IDX_54AE5F9419EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE module (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE module_admin (module_id INT NOT NULL, admin_id INT NOT NULL, INDEX IDX_81027D18AFC2B591 (module_id), INDEX IDX_81027D18642B8210 (admin_id), PRIMARY KEY(module_id, admin_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE admin (id INT AUTO_INCREMENT NOT NULL, role_id INT DEFAULT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, INDEX IDX_880E0D76D60322AC (role_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, ifu VARCHAR(255) NOT NULL, phone_one VARCHAR(255) NOT NULL, phone_two VARCHAR(255) DEFAULT NULL, mail VARCHAR(255) DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, gps LONGTEXT DEFAULT NULL, enseigne_col VARCHAR(55) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE consignataire ADD CONSTRAINT FK_23875DB119EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE armateur ADD CONSTRAINT FK_54AE5F9419EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE module_admin ADD CONSTRAINT FK_81027D18AFC2B591 FOREIGN KEY (module_id) REFERENCES module (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE module_admin ADD CONSTRAINT FK_81027D18642B8210 FOREIGN KEY (admin_id) REFERENCES admin (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE admin ADD CONSTRAINT FK_880E0D76D60322AC FOREIGN KEY (role_id) REFERENCES role (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE admin DROP FOREIGN KEY FK_880E0D76D60322AC');
        $this->addSql('ALTER TABLE module_admin DROP FOREIGN KEY FK_81027D18AFC2B591');
        $this->addSql('ALTER TABLE module_admin DROP FOREIGN KEY FK_81027D18642B8210');
        $this->addSql('ALTER TABLE consignataire DROP FOREIGN KEY FK_23875DB119EB6921');
        $this->addSql('ALTER TABLE armateur DROP FOREIGN KEY FK_54AE5F9419EB6921');
        $this->addSql('DROP TABLE consignataire');
        $this->addSql('DROP TABLE armateur');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE module');
        $this->addSql('DROP TABLE module_admin');
        $this->addSql('DROP TABLE admin');
        $this->addSql('DROP TABLE client');
    }
}
