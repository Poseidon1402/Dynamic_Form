<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220220194343 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Courses ADD sector_id INT NOT NULL');
        $this->addSql('ALTER TABLE Courses ADD CONSTRAINT FK_661863D0DE95C867 FOREIGN KEY (sector_id) REFERENCES Sectors (id)');
        $this->addSql('CREATE INDEX IDX_661863D0DE95C867 ON Courses (sector_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('ALTER TABLE Courses DROP FOREIGN KEY FK_661863D0DE95C867');
        $this->addSql('DROP INDEX IDX_661863D0DE95C867 ON Courses');
        $this->addSql('ALTER TABLE Courses DROP sector_id, CHANGE name name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE Sectors CHANGE name name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
