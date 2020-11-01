<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201030134406 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE shipment (id INT AUTO_INCREMENT NOT NULL, date DATE NOT NULL, shipmented INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tovari (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, price INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE zakazchiki (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, score VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE zakazi (id INT AUTO_INCREMENT NOT NULL, tovar_id INT DEFAULT NULL, zakazchik_id INT NOT NULL, INDEX IDX_FBA5486C11D9B81B (tovar_id), INDEX IDX_FBA5486CC481A369 (zakazchik_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE zakazi ADD CONSTRAINT FK_FBA5486C11D9B81B FOREIGN KEY (tovar_id) REFERENCES tovari (id)');
        $this->addSql('ALTER TABLE zakazi ADD CONSTRAINT FK_FBA5486CC481A369 FOREIGN KEY (zakazchik_id) REFERENCES zakazchiki (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE zakazi DROP FOREIGN KEY FK_FBA5486C11D9B81B');
        $this->addSql('ALTER TABLE zakazi DROP FOREIGN KEY FK_FBA5486CC481A369');
        $this->addSql('DROP TABLE shipment');
        $this->addSql('DROP TABLE tovari');
        $this->addSql('DROP TABLE zakazchiki');
        $this->addSql('DROP TABLE zakazi');
    }
}
