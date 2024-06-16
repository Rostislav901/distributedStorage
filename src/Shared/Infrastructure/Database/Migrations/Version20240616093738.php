<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240616093738 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE RefreshToken_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE RefreshToken (id INT NOT NULL, user_ulid VARCHAR(26) DEFAULT NULL, createdAt TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, refreshToken VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, valid TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_7142379EB8098490 ON RefreshToken (user_ulid)');
        $this->addSql('COMMENT ON COLUMN RefreshToken.createdAt IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE main_events (ulid VARCHAR(26) NOT NULL, title VARCHAR(64) NOT NULL, description VARCHAR(64) NOT NULL, location VARCHAR(64) NOT NULL, creator_ulid VARCHAR(26) NOT NULL, startTime INT NOT NULL, endTime INT NOT NULL, fileName VARCHAR(64) NOT NULL, fileId VARCHAR(128) NOT NULL, filesize INT NOT NULL, createdAt TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(ulid, title))');
        $this->addSql('COMMENT ON COLUMN main_events.createdAt IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE main_user (ulid VARCHAR(26) NOT NULL, password VARCHAR(255) NOT NULL, roles TEXT NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, createdAt TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(ulid))');
        $this->addSql('COMMENT ON COLUMN main_user.roles IS \'(DC2Type:array)\'');
        $this->addSql('COMMENT ON COLUMN main_user.createdAt IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE RefreshToken ADD CONSTRAINT FK_7142379EB8098490 FOREIGN KEY (user_ulid) REFERENCES main_user (ulid) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE RefreshToken_id_seq CASCADE');
        $this->addSql('ALTER TABLE RefreshToken DROP CONSTRAINT FK_7142379EB8098490');
        $this->addSql('DROP TABLE RefreshToken');
        $this->addSql('DROP TABLE main_events');
        $this->addSql('DROP TABLE main_user');
    }
}
