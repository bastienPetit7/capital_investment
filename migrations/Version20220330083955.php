<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220330083955 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE widget_line DROP FOREIGN KEY FK_49E3BF4929F5F9D6');
        $this->addSql('DROP INDEX IDX_49E3BF4929F5F9D6 ON widget_line');
        $this->addSql('ALTER TABLE widget_line DROP widget_code_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE widget_line ADD widget_code_id INT NOT NULL');
        $this->addSql('ALTER TABLE widget_line ADD CONSTRAINT FK_49E3BF4929F5F9D6 FOREIGN KEY (widget_code_id) REFERENCES widget_code (id)');
        $this->addSql('CREATE INDEX IDX_49E3BF4929F5F9D6 ON widget_line (widget_code_id)');
    }
}