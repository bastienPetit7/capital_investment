<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220320130236 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reporting DROP FOREIGN KEY FK_BD7CFA9F6B62CD11');
        $this->addSql('DROP INDEX IDX_BD7CFA9F6B62CD11 ON reporting');
        $this->addSql('ALTER TABLE reporting DROP investor_id_id, DROP created_at, DROP reporting_name');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reporting ADD investor_id_id INT DEFAULT NULL, ADD created_at DATETIME DEFAULT NULL, ADD reporting_name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE reporting ADD CONSTRAINT FK_BD7CFA9F6B62CD11 FOREIGN KEY (investor_id_id) REFERENCES investor (id)');
        $this->addSql('CREATE INDEX IDX_BD7CFA9F6B62CD11 ON reporting (investor_id_id)');
    }
}
