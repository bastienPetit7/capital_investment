<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220527081419 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE position CHANGE tp1 tp1 VARCHAR(255) DEFAULT NULL, CHANGE tp2 tp2 VARCHAR(255) DEFAULT NULL, CHANGE tp3 tp3 VARCHAR(255) DEFAULT NULL, CHANGE tp4 tp4 VARCHAR(255) DEFAULT NULL, CHANGE stop_loss stop_loss VARCHAR(255) DEFAULT NULL, CHANGE price price VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE position CHANGE tp1 tp1 DOUBLE PRECISION DEFAULT NULL, CHANGE tp2 tp2 DOUBLE PRECISION DEFAULT NULL, CHANGE tp3 tp3 DOUBLE PRECISION DEFAULT NULL, CHANGE tp4 tp4 DOUBLE PRECISION DEFAULT NULL, CHANGE stop_loss stop_loss DOUBLE PRECISION DEFAULT NULL, CHANGE price price DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
    }
}
