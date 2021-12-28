<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211228221226 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE document (id INT AUTO_INCREMENT NOT NULL, list_id INT NOT NULL, file_name VARCHAR(255) NOT NULL, extension_name VARCHAR(255) NOT NULL, path_to_file VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, type VARCHAR(255) NOT NULL, INDEX IDX_D8698A763DAE168B (list_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE freemium (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, created_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_EEBB9EA4A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE investor (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, UNIQUE INDEX UNIQ_8BBAED26A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE list_document (id INT AUTO_INCREMENT NOT NULL, investor_id INT NOT NULL, UNIQUE INDEX UNIQ_A604B9169AE528DA (investor_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE premium (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, started_at DATETIME NOT NULL, expired_at DATETIME NOT NULL, status VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_893D1485A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE study_case (id INT AUTO_INCREMENT NOT NULL, theme_id INT NOT NULL, name VARCHAR(255) NOT NULL, image_path VARCHAR(255) NOT NULL, file_to_path VARCHAR(255) NOT NULL, number_of_download INT NOT NULL, price INT NOT NULL, INDEX IDX_7D0713D59027487 (theme_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE subscription (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, price INT NOT NULL, period_in_days INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE theme_study_case (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, image_path VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE theme_video (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, image_path VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE video (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, theme_id INT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, path_to_file VARCHAR(255) NOT NULL, INDEX IDX_7CC7DA2CA76ED395 (user_id), INDEX IDX_7CC7DA2C59027487 (theme_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE wallet (id INT AUTO_INCREMENT NOT NULL, investor_id INT NOT NULL, initial_amount INT NOT NULL, actual_amount INT NOT NULL, UNIQUE INDEX UNIQ_7C68921F9AE528DA (investor_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A763DAE168B FOREIGN KEY (list_id) REFERENCES list_document (id)');
        $this->addSql('ALTER TABLE freemium ADD CONSTRAINT FK_EEBB9EA4A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE investor ADD CONSTRAINT FK_8BBAED26A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE list_document ADD CONSTRAINT FK_A604B9169AE528DA FOREIGN KEY (investor_id) REFERENCES investor (id)');
        $this->addSql('ALTER TABLE premium ADD CONSTRAINT FK_893D1485A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE study_case ADD CONSTRAINT FK_7D0713D59027487 FOREIGN KEY (theme_id) REFERENCES theme_study_case (id)');
        $this->addSql('ALTER TABLE video ADD CONSTRAINT FK_7CC7DA2CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE video ADD CONSTRAINT FK_7CC7DA2C59027487 FOREIGN KEY (theme_id) REFERENCES theme_video (id)');
        $this->addSql('ALTER TABLE wallet ADD CONSTRAINT FK_7C68921F9AE528DA FOREIGN KEY (investor_id) REFERENCES investor (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE list_document DROP FOREIGN KEY FK_A604B9169AE528DA');
        $this->addSql('ALTER TABLE wallet DROP FOREIGN KEY FK_7C68921F9AE528DA');
        $this->addSql('ALTER TABLE document DROP FOREIGN KEY FK_D8698A763DAE168B');
        $this->addSql('ALTER TABLE study_case DROP FOREIGN KEY FK_7D0713D59027487');
        $this->addSql('ALTER TABLE video DROP FOREIGN KEY FK_7CC7DA2C59027487');
        $this->addSql('DROP TABLE document');
        $this->addSql('DROP TABLE freemium');
        $this->addSql('DROP TABLE investor');
        $this->addSql('DROP TABLE list_document');
        $this->addSql('DROP TABLE premium');
        $this->addSql('DROP TABLE study_case');
        $this->addSql('DROP TABLE subscription');
        $this->addSql('DROP TABLE theme_study_case');
        $this->addSql('DROP TABLE theme_video');
        $this->addSql('DROP TABLE video');
        $this->addSql('DROP TABLE wallet');
    }
}
