<?php

/*
 * (c) Tristan Bonsor <tristan@agogpixel.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * @author kidthales <kidthales@agogpixel.com>
 */
final class Version20251027054934 extends AbstractMigration
{
    /**
     * @return string
     */
    public function getDescription(): string
    {
        return 'Create/Drop the user table.';
    }

    /**
     * @param Schema $schema
     * @return void
     */
    public function up(Schema $schema): void
    {
        $this->addSql(<<<'SQL'
            CREATE TABLE user (
              id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
              github_id BIGINT NOT NULL,
              created_at BIGINT NOT NULL
            )
        SQL
        );
        $this->addSql('CREATE UNIQUE INDEX UNIQ_IDENTIFIER_GITHUB_ID ON user (github_id)');
    }

    /**
     * @param Schema $schema
     * @return void
     */
    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE user');
    }
}
