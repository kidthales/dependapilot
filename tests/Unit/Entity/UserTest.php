<?php

/*
 * (c) Tristan Bonsor <tristan@agogpixel.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\Tests\Unit\Entity;

use App\Entity\GithubRepo;
use App\Entity\User;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

/**
 * @author kidthales <kidthales@agogpixel.com>
 */
#[CoversClass(User::class)]
final class UserTest extends TestCase
{
    /**
     * @return void
     */
    public function testDefaultIdIsNull(): void
    {
        self::assertNull(new User()->getId());
    }

    /**
     * @return void
     */
    public function testDefaultGithubIdIsNull(): void
    {
        self::assertNull(new User()->getGithubId());
    }

    /**
     * @return void
     */
    public function testDefaultGithubReposIsEmpty(): void
    {
        self::assertEmpty(new User()->getGithubRepos());
    }

    /**
     * @return void
     */
    public function testDefaultUserIdentifierIsEmptyString(): void
    {
        self::assertSame('', new User()->getUserIdentifier());
    }

    /**
     * @return void
     */
    public function testAddGithubRepo(): void
    {
        $user = new User();
        $repo = new GithubRepo();
        $user->addGithubRepo($repo);
        self::assertCount(1, $user->getGithubRepos());
        self::assertSame($repo, $user->getGithubRepos()->first());
    }

    /**
     * @return void
     */
    public function testRemoveGithubRepo(): void
    {
        $user = new User();
        $repo1 = new GithubRepo();
        $repo2 = new GithubRepo();
        $user->addGithubRepo($repo1);
        $user->addGithubRepo($repo2);
        self::assertCount(2, $user->getGithubRepos());
        $user->removeGithubRepo($repo1);
        self::assertCount(1, $user->getGithubRepos());
        self::assertSame($repo2, $user->getGithubRepos()->first());
    }

    /**
     * @return void
     */
    public function testOnlyHasRoleUser(): void
    {
        $roles = new User()->getRoles();
        self::assertCount(1, $roles);
        self::assertSame('ROLE_USER', $roles[0]);
    }

    /**
     * @return void
     */
    public function testSetGithubId(): void
    {
        $user = new User();
        $user->setGithubId(1);
        self::assertSame(1, $user->getGithubId());
        $user->setGithubId('11');
        self::assertSame('11', $user->getGithubId());
    }
}
