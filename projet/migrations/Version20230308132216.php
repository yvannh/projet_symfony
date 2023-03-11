<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230308132216 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX id_nom ON contact');
        $this->addSql('ALTER TABLE contact ADD id INT AUTO_INCREMENT NOT NULL, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE user DROP prenom, DROP email, CHANGE login login VARCHAR(255) NOT NULL, CHANGE password password VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contact MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON contact');
        $this->addSql('ALTER TABLE contact DROP id');
        $this->addSql('CREATE INDEX id_nom ON contact (user)');
        $this->addSql('ALTER TABLE user ADD prenom TEXT NOT NULL, ADD email TEXT NOT NULL, CHANGE login login TEXT NOT NULL, CHANGE password password TEXT NOT NULL');
    }
}
