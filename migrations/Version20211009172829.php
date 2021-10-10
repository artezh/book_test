<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20211009172829 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Добввление полей в таблицу user';
    }

    public function up(Schema $schema): void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE `user` ADD `is_active` tinyint(1) unsigned DEFAULT 0 NOT NULL COMMENT \'Метка активности пользователя\'');
        $this->addSql('ALTER TABLE `user` ADD `created` DATETIME NOT NULL COMMENT \'Дата создания пользователя\'');
        $this->addSql('ALTER TABLE `user` ADD `modified` DATETIME COMMENT \'Дата последнего редактирования пользователя\'');
    }

    public function down(Schema $schema): void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE `user` DROP `is_active`');
        $this->addSql('ALTER TABLE `user` DROP `created`');
        $this->addSql('ALTER TABLE `user` DROP `modified`');
    }
}
