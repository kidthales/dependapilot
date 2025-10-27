<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251027054934 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create/Drop the user table.';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE user (
              id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
              github_id BIGINT NOT NULL,
              created_at BIGINT NOT NULL
            )
        SQL);
        $this->addSql('CREATE UNIQUE INDEX UNIQ_IDENTIFIER_GITHUB_ID ON user (github_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user');
    }
}
