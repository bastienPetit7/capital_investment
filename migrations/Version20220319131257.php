<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220319131257 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reporting ADD created_at DATETIME DEFAULT NULL, DROP date, DROP wallet, DROP interets, DROP interets_composé');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reporting ADD date VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD wallet DOUBLE PRECISION NOT NULL, ADD interets DOUBLE PRECISION DEFAULT NULL, ADD interets_composé DOUBLE PRECISION DEFAULT NULL, DROP created_at');
    }
}
