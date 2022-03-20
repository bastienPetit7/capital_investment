<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220320130311 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reporting ADD wallet_id INT NOT NULL');
        $this->addSql('ALTER TABLE reporting ADD CONSTRAINT FK_BD7CFA9F712520F3 FOREIGN KEY (wallet_id) REFERENCES wallet (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BD7CFA9F712520F3 ON reporting (wallet_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reporting DROP FOREIGN KEY FK_BD7CFA9F712520F3');
        $this->addSql('DROP INDEX UNIQ_BD7CFA9F712520F3 ON reporting');
        $this->addSql('ALTER TABLE reporting DROP wallet_id');
    }
}
