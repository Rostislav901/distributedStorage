<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240616093659 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE server1_events (ulid VARCHAR(26) NOT NULL, title VARCHAR(64) NOT NULL, description VARCHAR(64) NOT NULL, location VARCHAR(64) NOT NULL, creator_ulid VARCHAR(26) NOT NULL, startTime INT NOT NULL, endTime INT NOT NULL, fileName VARCHAR(64) NOT NULL, fileId VARCHAR(128) NOT NULL, filesize INT NOT NULL, createdAt TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(ulid, title))');
        $this->addSql('COMMENT ON COLUMN server1_events.createdAt IS \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE server1_events');
    }
}
