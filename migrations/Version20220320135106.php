<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220320135106 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cash_in (id INT AUTO_INCREMENT NOT NULL, reporting_movement_id INT NOT NULL, amount INT NOT NULL, UNIQUE INDEX UNIQ_DDAFE5365C5AA200 (reporting_movement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cash_out (id INT AUTO_INCREMENT NOT NULL, reporting_movement_id INT NOT NULL, amount INT NOT NULL, UNIQUE INDEX UNIQ_E7B6D7FC5C5AA200 (reporting_movement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE interest_earn (id INT AUTO_INCREMENT NOT NULL, reporting_movement_id INT NOT NULL, amount INT NOT NULL, UNIQUE INDEX UNIQ_7D84AE9D5C5AA200 (reporting_movement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reporting_movement (id INT AUTO_INCREMENT NOT NULL, reporting_id INT NOT NULL, created_at DATETIME NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_2C06EF0E27EE0E60 (reporting_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cash_in ADD CONSTRAINT FK_DDAFE5365C5AA200 FOREIGN KEY (reporting_movement_id) REFERENCES reporting_movement (id)');
        $this->addSql('ALTER TABLE cash_out ADD CONSTRAINT FK_E7B6D7FC5C5AA200 FOREIGN KEY (reporting_movement_id) REFERENCES reporting_movement (id)');
        $this->addSql('ALTER TABLE interest_earn ADD CONSTRAINT FK_7D84AE9D5C5AA200 FOREIGN KEY (reporting_movement_id) REFERENCES reporting_movement (id)');
        $this->addSql('ALTER TABLE reporting_movement ADD CONSTRAINT FK_2C06EF0E27EE0E60 FOREIGN KEY (reporting_id) REFERENCES reporting (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cash_in DROP FOREIGN KEY FK_DDAFE5365C5AA200');
        $this->addSql('ALTER TABLE cash_out DROP FOREIGN KEY FK_E7B6D7FC5C5AA200');
        $this->addSql('ALTER TABLE interest_earn DROP FOREIGN KEY FK_7D84AE9D5C5AA200');
        $this->addSql('DROP TABLE cash_in');
        $this->addSql('DROP TABLE cash_out');
        $this->addSql('DROP TABLE interest_earn');
        $this->addSql('DROP TABLE reporting_movement');
    }
}
