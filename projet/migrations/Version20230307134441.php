<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230307134441 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, login VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE utilisateur');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE contact (id_nom INT NOT NULL, id_contact INT NOT NULL, INDEX id_nom (id_nom)) DEFAULT CHARACTER SET utf8mb3 COLLATE `utf8mb3_bin` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE utilisateur (id_nom INT AUTO_INCREMENT NOT NULL, nom TEXT CHARACTER SET utf8mb3 NOT NULL COLLATE `utf8mb3_bin`, prenom TEXT CHARACTER SET utf8mb3 NOT NULL COLLATE `utf8mb3_bin`, num TEXT CHARACTER SET utf8mb3 NOT NULL COLLATE `utf8mb3_bin`, email TEXT CHARACTER SET utf8mb3 NOT NULL COLLATE `utf8mb3_bin`, PRIMARY KEY(id_nom)) DEFAULT CHARACTER SET utf8mb3 COLLATE `utf8mb3_bin` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
