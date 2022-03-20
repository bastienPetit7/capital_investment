<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220320134407 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE reporting_details');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE reporting_details (id INT AUTO_INCREMENT NOT NULL, reporting_id INT DEFAULT NULL, date DATETIME NOT NULL, initial_wallet DOUBLE PRECISION NOT NULL, interest DOUBLE PRECISION NOT NULL, compound_interest DOUBLE PRECISION DEFAULT NULL, actual_wallet DOUBLE PRECISION NOT NULL, INDEX IDX_A477282227EE0E60 (reporting_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE reporting_details ADD CONSTRAINT FK_A477282227EE0E60 FOREIGN KEY (reporting_id) REFERENCES reporting (id)');
    }
}
