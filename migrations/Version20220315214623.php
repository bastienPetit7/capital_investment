<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220315214623 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE position (id INT AUTO_INCREMENT NOT NULL, position_type_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, tp1 DOUBLE PRECISION DEFAULT NULL, tp2 DOUBLE PRECISION DEFAULT NULL, tp3 DOUBLE PRECISION DEFAULT NULL, tp4 DOUBLE PRECISION DEFAULT NULL, tp5 DOUBLE PRECISION DEFAULT NULL, tp6 DOUBLE PRECISION DEFAULT NULL, tp7 DOUBLE PRECISION DEFAULT NULL, tp8 DOUBLE PRECISION DEFAULT NULL, stop_loss DOUBLE PRECISION DEFAULT NULL, created_at DATETIME NOT NULL, sell_at DOUBLE PRECISION DEFAULT NULL, is_active TINYINT(1) NOT NULL, INDEX IDX_462CE4F556BD9D60 (position_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE position_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reporting (id INT AUTO_INCREMENT NOT NULL, investor_id_id INT DEFAULT NULL, date VARCHAR(255) NOT NULL, reporting_name VARCHAR(255) DEFAULT NULL, wallet DOUBLE PRECISION NOT NULL, interets DOUBLE PRECISION DEFAULT NULL, interets_composé DOUBLE PRECISION DEFAULT NULL, INDEX IDX_BD7CFA9F6B62CD11 (investor_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE position ADD CONSTRAINT FK_462CE4F556BD9D60 FOREIGN KEY (position_type_id) REFERENCES position_type (id)');
        $this->addSql('ALTER TABLE reporting ADD CONSTRAINT FK_BD7CFA9F6B62CD11 FOREIGN KEY (investor_id_id) REFERENCES investor (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE position DROP FOREIGN KEY FK_462CE4F556BD9D60');
        $this->addSql('DROP TABLE position');
        $this->addSql('DROP TABLE position_type');
        $this->addSql('DROP TABLE reporting');
    }
}
