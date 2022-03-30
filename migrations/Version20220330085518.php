<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220330085518 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE widget_content_line (id INT AUTO_INCREMENT NOT NULL, widget_line_id INT NOT NULL, widget_code_id INT NOT NULL, INDEX IDX_F8468CB243547283 (widget_line_id), INDEX IDX_F8468CB229F5F9D6 (widget_code_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE widget_content_line ADD CONSTRAINT FK_F8468CB243547283 FOREIGN KEY (widget_line_id) REFERENCES widget_line (id)');
        $this->addSql('ALTER TABLE widget_content_line ADD CONSTRAINT FK_F8468CB229F5F9D6 FOREIGN KEY (widget_code_id) REFERENCES widget_code (id)');
        $this->addSql('ALTER TABLE widget_line DROP place');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE widget_content_line');
        $this->addSql('ALTER TABLE widget_line ADD place INT NOT NULL');
    }
}
