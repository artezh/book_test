<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211009183201 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Создание таблицы книг';
    }

    public function up(Schema $schema): void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE book (id INT(11) UNSIGNED AUTO_INCREMENT NOT NULL, '
            . 'author_id INT(11) UNSIGNED NOT NULL, title VARCHAR(255) NOT NULL, '
            . 'price INT(11) UNSIGNED NOT NULL DEFAULT 0, created datetime NOT NULL DEFAULT CURRENT_TIME, '
            . 'CONSTRAINT book_author_id_fk FOREIGN KEY (author_id)  REFERENCES author (id) ON DELETE CASCADE, '
            . 'UNIQUE INDEX UNIQ_book_title (title), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE book');
    }
}
