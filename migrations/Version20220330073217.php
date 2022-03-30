<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220330073217 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE widget (id INT AUTO_INCREMENT NOT NULL, widget_theme_id INT NOT NULL, INDEX IDX_85F91ED0B56FA9A6 (widget_theme_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE widget_code (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, display_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE widget_line (id INT AUTO_INCREMENT NOT NULL, widget_code_id INT NOT NULL, place INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_49E3BF4929F5F9D6 (widget_code_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE widget_theme (id INT AUTO_INCREMENT NOT NULL, image_path VARCHAR(255) DEFAULT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE widget ADD CONSTRAINT FK_85F91ED0B56FA9A6 FOREIGN KEY (widget_theme_id) REFERENCES widget_theme (id)');
        $this->addSql('ALTER TABLE widget_line ADD CONSTRAINT FK_49E3BF4929F5F9D6 FOREIGN KEY (widget_code_id) REFERENCES widget_code (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE widget_line DROP FOREIGN KEY FK_49E3BF4929F5F9D6');
        $this->addSql('ALTER TABLE widget DROP FOREIGN KEY FK_85F91ED0B56FA9A6');
        $this->addSql('DROP TABLE widget');
        $this->addSql('DROP TABLE widget_code');
        $this->addSql('DROP TABLE widget_line');
        $this->addSql('DROP TABLE widget_theme');
    }
}
