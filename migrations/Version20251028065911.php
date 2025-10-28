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
final class Version20251028065911 extends AbstractMigration
{
    /**
     * @return string
     */
    public function getDescription(): string
    {
        return 'Create/Drop the github_repo table.';
    }

    /**
     * @param Schema $schema
     * @return void
     */
    public function up(Schema $schema): void
    {
        $this->addSql(<<<'SQL'
            CREATE TABLE github_repo (
              id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
              owner VARCHAR(39) NOT NULL,
              project VARCHAR(100) NOT NULL
            )
        SQL);
        $this->addSql('CREATE UNIQUE INDEX UNIQ_IDENTIFIER_OWNER_PROJECT ON github_repo (owner, project)');
    }

    /**
     * @param Schema $schema
     * @return void
     */
    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE github_repo');
    }
}
