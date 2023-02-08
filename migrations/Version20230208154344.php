<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230208154344 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE borrower (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE book ADD borrower_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE book ADD CONSTRAINT FK_CBE5A33111CE312B FOREIGN KEY (borrower_id) REFERENCES borrower (id)');
        $this->addSql('CREATE INDEX IDX_CBE5A33111CE312B ON book (borrower_id)');
        $this->addSql('ALTER TABLE book RENAME INDEX category_id TO IDX_CBE5A33112469DE2');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE book DROP FOREIGN KEY FK_CBE5A33111CE312B');
        $this->addSql('DROP TABLE borrower');
        $this->addSql('DROP INDEX IDX_CBE5A33111CE312B ON book');
        $this->addSql('ALTER TABLE book DROP borrower_id');
        $this->addSql('ALTER TABLE book RENAME INDEX idx_cbe5a33112469de2 TO category_id');
    }
}
