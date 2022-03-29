<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220329165138 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE capital_investment_asset (id INT AUTO_INCREMENT NOT NULL, total_asset INT DEFAULT NULL, recovery_found_total INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cash_in (id INT AUTO_INCREMENT NOT NULL, reporting_movement_id INT NOT NULL, amount INT NOT NULL, UNIQUE INDEX UNIQ_DDAFE5365C5AA200 (reporting_movement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cash_out (id INT AUTO_INCREMENT NOT NULL, reporting_movement_id INT NOT NULL, amount INT NOT NULL, UNIQUE INDEX UNIQ_E7B6D7FC5C5AA200 (reporting_movement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE document (id INT AUTO_INCREMENT NOT NULL, list_id INT NOT NULL, file_name VARCHAR(255) NOT NULL, extension_name VARCHAR(255) NOT NULL, path_to_file VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, type VARCHAR(255) NOT NULL, INDEX IDX_D8698A763DAE168B (list_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE freemium (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, created_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_EEBB9EA4A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE interest_earn (id INT AUTO_INCREMENT NOT NULL, reporting_movement_id INT NOT NULL, amount INT NOT NULL, UNIQUE INDEX UNIQ_7D84AE9D5C5AA200 (reporting_movement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE investor (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, status VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_8BBAED26A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE list_document (id INT AUTO_INCREMENT NOT NULL, investor_id INT NOT NULL, UNIQUE INDEX UNIQ_A604B9169AE528DA (investor_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE newsletter (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `order` (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, created_at DATETIME NOT NULL, is_paid TINYINT(1) NOT NULL, reference VARCHAR(255) NOT NULL, authentification_monetico VARCHAR(255) DEFAULT NULL, INDEX IDX_F5299398A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_details (id INT AUTO_INCREMENT NOT NULL, my_order_id INT DEFAULT NULL, product VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, INDEX IDX_845CA2C1BFCDF877 (my_order_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE position (id INT AUTO_INCREMENT NOT NULL, position_type_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, tp1 DOUBLE PRECISION DEFAULT NULL, tp2 DOUBLE PRECISION DEFAULT NULL, tp3 DOUBLE PRECISION DEFAULT NULL, tp4 DOUBLE PRECISION DEFAULT NULL, tp5 DOUBLE PRECISION DEFAULT NULL, tp6 DOUBLE PRECISION DEFAULT NULL, tp7 DOUBLE PRECISION DEFAULT NULL, tp8 DOUBLE PRECISION DEFAULT NULL, stop_loss DOUBLE PRECISION DEFAULT NULL, created_at DATETIME NOT NULL, sell_at DOUBLE PRECISION DEFAULT NULL, is_active TINYINT(1) NOT NULL, week_of_creation VARCHAR(255) DEFAULT NULL, INDEX IDX_462CE4F556BD9D60 (position_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE position_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE premium (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, started_at DATETIME NOT NULL, expired_at DATETIME NOT NULL, status VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_893D1485A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reporting (id INT AUTO_INCREMENT NOT NULL, wallet_id INT NOT NULL, UNIQUE INDEX UNIQ_BD7CFA9F712520F3 (wallet_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reporting_movement (id INT AUTO_INCREMENT NOT NULL, reporting_id INT NOT NULL, created_at DATETIME NOT NULL, name VARCHAR(255) NOT NULL, month VARCHAR(255) NOT NULL, year VARCHAR(255) NOT NULL, interest_rates DOUBLE PRECISION DEFAULT NULL, wallet_amount_before_movement INT NOT NULL, wallet_amount_after_movement INT NOT NULL, INDEX IDX_2C06EF0E27EE0E60 (reporting_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE study_case (id INT AUTO_INCREMENT NOT NULL, theme_id INT NOT NULL, name VARCHAR(255) NOT NULL, image_path VARCHAR(255) NOT NULL, path_to_file VARCHAR(255) NOT NULL, number_of_download INT NOT NULL, price INT NOT NULL, description LONGTEXT NOT NULL, file_name VARCHAR(255) NOT NULL, extension_name VARCHAR(255) NOT NULL, subtitle VARCHAR(255) DEFAULT NULL, is_main TINYINT(1) DEFAULT NULL, is_active TINYINT(1) DEFAULT NULL, is_new TINYINT(1) DEFAULT NULL, is_free TINYINT(1) DEFAULT NULL, created_at DATETIME DEFAULT NULL, extract LONGTEXT DEFAULT NULL, INDEX IDX_7D0713D59027487 (theme_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE subscription (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, price INT NOT NULL, period_in_days INT NOT NULL, sub_title VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, is_active TINYINT(1) DEFAULT NULL, is_main TINYINT(1) DEFAULT NULL, image_path VARCHAR(255) DEFAULT NULL, short_description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE subscription_subscription_key_point (subscription_id INT NOT NULL, subscription_key_point_id INT NOT NULL, INDEX IDX_4667A35B9A1887DC (subscription_id), INDEX IDX_4667A35B6F7D19BA (subscription_key_point_id), PRIMARY KEY(subscription_id, subscription_key_point_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE subscription_key_point (id INT AUTO_INCREMENT NOT NULL, key_point VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE theme_study_case (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, image_path VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE theme_video (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, image_path VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, company VARCHAR(255) DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, postal VARCHAR(255) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, country VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE video (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, theme_id INT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, path_to_file VARCHAR(255) NOT NULL, INDEX IDX_7CC7DA2CA76ED395 (user_id), INDEX IDX_7CC7DA2C59027487 (theme_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE wallet (id INT AUTO_INCREMENT NOT NULL, investor_id INT NOT NULL, initial_amount INT DEFAULT NULL, actual_amount INT DEFAULT NULL, status VARCHAR(255) DEFAULT NULL, interest_rates DOUBLE PRECISION DEFAULT NULL, interest_type VARCHAR(255) DEFAULT NULL, currency VARCHAR(255) DEFAULT NULL, interest_recovery_found INT DEFAULT NULL, total_actif INT DEFAULT NULL, UNIQUE INDEX UNIQ_7C68921F9AE528DA (investor_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cash_in ADD CONSTRAINT FK_DDAFE5365C5AA200 FOREIGN KEY (reporting_movement_id) REFERENCES reporting_movement (id)');
        $this->addSql('ALTER TABLE cash_out ADD CONSTRAINT FK_E7B6D7FC5C5AA200 FOREIGN KEY (reporting_movement_id) REFERENCES reporting_movement (id)');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A763DAE168B FOREIGN KEY (list_id) REFERENCES list_document (id)');
        $this->addSql('ALTER TABLE freemium ADD CONSTRAINT FK_EEBB9EA4A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE interest_earn ADD CONSTRAINT FK_7D84AE9D5C5AA200 FOREIGN KEY (reporting_movement_id) REFERENCES reporting_movement (id)');
        $this->addSql('ALTER TABLE investor ADD CONSTRAINT FK_8BBAED26A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE list_document ADD CONSTRAINT FK_A604B9169AE528DA FOREIGN KEY (investor_id) REFERENCES investor (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE order_details ADD CONSTRAINT FK_845CA2C1BFCDF877 FOREIGN KEY (my_order_id) REFERENCES `order` (id)');
        $this->addSql('ALTER TABLE position ADD CONSTRAINT FK_462CE4F556BD9D60 FOREIGN KEY (position_type_id) REFERENCES position_type (id)');
        $this->addSql('ALTER TABLE premium ADD CONSTRAINT FK_893D1485A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE reporting ADD CONSTRAINT FK_BD7CFA9F712520F3 FOREIGN KEY (wallet_id) REFERENCES wallet (id)');
        $this->addSql('ALTER TABLE reporting_movement ADD CONSTRAINT FK_2C06EF0E27EE0E60 FOREIGN KEY (reporting_id) REFERENCES reporting (id)');
        $this->addSql('ALTER TABLE study_case ADD CONSTRAINT FK_7D0713D59027487 FOREIGN KEY (theme_id) REFERENCES theme_study_case (id)');
        $this->addSql('ALTER TABLE subscription_subscription_key_point ADD CONSTRAINT FK_4667A35B9A1887DC FOREIGN KEY (subscription_id) REFERENCES subscription (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE subscription_subscription_key_point ADD CONSTRAINT FK_4667A35B6F7D19BA FOREIGN KEY (subscription_key_point_id) REFERENCES subscription_key_point (id) ON DELETE CASCADE');
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
        $this->addSql('ALTER TABLE order_details DROP FOREIGN KEY FK_845CA2C1BFCDF877');
        $this->addSql('ALTER TABLE position DROP FOREIGN KEY FK_462CE4F556BD9D60');
        $this->addSql('ALTER TABLE reporting_movement DROP FOREIGN KEY FK_2C06EF0E27EE0E60');
        $this->addSql('ALTER TABLE cash_in DROP FOREIGN KEY FK_DDAFE5365C5AA200');
        $this->addSql('ALTER TABLE cash_out DROP FOREIGN KEY FK_E7B6D7FC5C5AA200');
        $this->addSql('ALTER TABLE interest_earn DROP FOREIGN KEY FK_7D84AE9D5C5AA200');
        $this->addSql('ALTER TABLE subscription_subscription_key_point DROP FOREIGN KEY FK_4667A35B9A1887DC');
        $this->addSql('ALTER TABLE subscription_subscription_key_point DROP FOREIGN KEY FK_4667A35B6F7D19BA');
        $this->addSql('ALTER TABLE study_case DROP FOREIGN KEY FK_7D0713D59027487');
        $this->addSql('ALTER TABLE video DROP FOREIGN KEY FK_7CC7DA2C59027487');
        $this->addSql('ALTER TABLE freemium DROP FOREIGN KEY FK_EEBB9EA4A76ED395');
        $this->addSql('ALTER TABLE investor DROP FOREIGN KEY FK_8BBAED26A76ED395');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398A76ED395');
        $this->addSql('ALTER TABLE premium DROP FOREIGN KEY FK_893D1485A76ED395');
        $this->addSql('ALTER TABLE video DROP FOREIGN KEY FK_7CC7DA2CA76ED395');
        $this->addSql('ALTER TABLE reporting DROP FOREIGN KEY FK_BD7CFA9F712520F3');
        $this->addSql('DROP TABLE capital_investment_asset');
        $this->addSql('DROP TABLE cash_in');
        $this->addSql('DROP TABLE cash_out');
        $this->addSql('DROP TABLE document');
        $this->addSql('DROP TABLE freemium');
        $this->addSql('DROP TABLE interest_earn');
        $this->addSql('DROP TABLE investor');
        $this->addSql('DROP TABLE list_document');
        $this->addSql('DROP TABLE newsletter');
        $this->addSql('DROP TABLE `order`');
        $this->addSql('DROP TABLE order_details');
        $this->addSql('DROP TABLE position');
        $this->addSql('DROP TABLE position_type');
        $this->addSql('DROP TABLE premium');
        $this->addSql('DROP TABLE reporting');
        $this->addSql('DROP TABLE reporting_movement');
        $this->addSql('DROP TABLE study_case');
        $this->addSql('DROP TABLE subscription');
        $this->addSql('DROP TABLE subscription_subscription_key_point');
        $this->addSql('DROP TABLE subscription_key_point');
        $this->addSql('DROP TABLE theme_study_case');
        $this->addSql('DROP TABLE theme_video');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE video');
        $this->addSql('DROP TABLE wallet');
    }
}
