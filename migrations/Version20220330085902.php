<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220330085902 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE widget_line ADD widget_id INT NOT NULL');
        $this->addSql('ALTER TABLE widget_line ADD CONSTRAINT FK_49E3BF49FBE885E2 FOREIGN KEY (widget_id) REFERENCES widget (id)');
        $this->addSql('CREATE INDEX IDX_49E3BF49FBE885E2 ON widget_line (widget_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE widget_line DROP FOREIGN KEY FK_49E3BF49FBE885E2');
        $this->addSql('DROP INDEX IDX_49E3BF49FBE885E2 ON widget_line');
        $this->addSql('ALTER TABLE widget_line DROP widget_id');
    }
}
