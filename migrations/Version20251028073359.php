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
final class Version20251028073359 extends AbstractMigration
{
    /**
     * @return string
     */
    public function getDescription(): string
    {
        return 'Create/Drop the user_github_repo join table.';
    }

    /**
     * @param Schema $schema
     * @return void
     */
    public function up(Schema $schema): void
    {
        $this->addSql(<<<'SQL'
            CREATE TABLE user_github_repo (
              user_id INTEGER NOT NULL,
              github_repo_id INTEGER NOT NULL,
              PRIMARY KEY(user_id, github_repo_id),
              CONSTRAINT FK_4F7908BA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE,
              CONSTRAINT FK_4F7908BB23C03A9 FOREIGN KEY (github_repo_id) REFERENCES github_repo (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE
            )
        SQL);
        $this->addSql('CREATE INDEX IDX_4F7908BA76ED395 ON user_github_repo (user_id)');
        $this->addSql('CREATE INDEX IDX_4F7908BB23C03A9 ON user_github_repo (github_repo_id)');
    }

    /**
     * @param Schema $schema
     * @return void
     */
    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE user_github_repo');
    }
}
