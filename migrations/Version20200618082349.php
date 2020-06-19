<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200618082349 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE articles (id INT AUTO_INCREMENT NOT NULL, users_id INT NOT NULL, categories_id INT NOT NULL, titre VARCHAR(255) NOT NULL, slug VARCHAR(128) NOT NULL, contenu LONGTEXT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, featured_image VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_BFDD3168989D9B62 (slug), INDEX IDX_BFDD316867B3B43D (users_id), INDEX IDX_BFDD3168A21214B7 (categories_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, slug VARCHAR(128) NOT NULL, UNIQUE INDEX UNIQ_3AF34668989D9B62 (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commentaires (id INT AUTO_INCREMENT NOT NULL, articles_id INT NOT NULL, parent_id_id INT DEFAULT NULL, user_id INT NOT NULL, users_id INT NOT NULL, pseudo VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, contenu LONGTEXT NOT NULL, actif TINYINT(1) NOT NULL, rgpd TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_D9BEC0C41EBAF6CC (articles_id), INDEX IDX_D9BEC0C4B3750AF4 (parent_id_id), INDEX IDX_D9BEC0C4A76ED395 (user_id), INDEX IDX_D9BEC0C467B3B43D (users_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reset_password_request (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', expires_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7CE748AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, is_verified TINYINT(1) NOT NULL, facebook_id VARCHAR(255) DEFAULT NULL, google_id VARCHAR(255) DEFAULT NULL, avatar VARCHAR(255) DEFAULT NULL, pseudo VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_1483A5E9E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE articles ADD CONSTRAINT FK_BFDD316867B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE articles ADD CONSTRAINT FK_BFDD3168A21214B7 FOREIGN KEY (categories_id) REFERENCES categories (id)');
        $this->addSql('ALTER TABLE commentaires ADD CONSTRAINT FK_D9BEC0C41EBAF6CC FOREIGN KEY (articles_id) REFERENCES articles (id)');
        $this->addSql('ALTER TABLE commentaires ADD CONSTRAINT FK_D9BEC0C4B3750AF4 FOREIGN KEY (parent_id_id) REFERENCES commentaires (id)');
        $this->addSql('ALTER TABLE commentaires ADD CONSTRAINT FK_D9BEC0C4A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE commentaires ADD CONSTRAINT FK_D9BEC0C467B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE commentaires DROP FOREIGN KEY FK_D9BEC0C41EBAF6CC');
        $this->addSql('ALTER TABLE articles DROP FOREIGN KEY FK_BFDD3168A21214B7');
        $this->addSql('ALTER TABLE commentaires DROP FOREIGN KEY FK_D9BEC0C4B3750AF4');
        $this->addSql('ALTER TABLE articles DROP FOREIGN KEY FK_BFDD316867B3B43D');
        $this->addSql('ALTER TABLE commentaires DROP FOREIGN KEY FK_D9BEC0C4A76ED395');
        $this->addSql('ALTER TABLE commentaires DROP FOREIGN KEY FK_D9BEC0C467B3B43D');
        $this->addSql('ALTER TABLE reset_password_request DROP FOREIGN KEY FK_7CE748AA76ED395');
        $this->addSql('DROP TABLE articles');
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE commentaires');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('DROP TABLE users');
    }
}
