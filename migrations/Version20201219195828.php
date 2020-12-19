<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201219195828 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE contrat ADD CONSTRAINT FK_60349993181A8BA FOREIGN KEY (voiture_id) REFERENCES voiture (id)');
        $this->addSql('CREATE INDEX IDX_60349993181A8BA ON contrat (voiture_id)');
        $this->addSql('ALTER TABLE voiture CHANGE marque marque VARCHAR(30) NOT NULL, CHANGE couleur couleur VARCHAR(20) NOT NULL, CHANGE description description LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE voiture RENAME INDEX matricule_2 TO UNIQ_E9E2810F12B2DC9C');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE contrat DROP FOREIGN KEY FK_60349993181A8BA');
        $this->addSql('DROP INDEX IDX_60349993181A8BA ON contrat');
        $this->addSql('ALTER TABLE voiture CHANGE marque marque VARCHAR(20) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE couleur couleur VARCHAR(30) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE description description VARCHAR(20) DEFAULT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE voiture RENAME INDEX uniq_e9e2810f12b2dc9c TO matricule_2');
    }
}
