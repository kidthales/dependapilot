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
#[CoversClass(GithubRepo::class)]
final class GitHubRepoTest extends TestCase
{
    /**
     * @return void
     */
    public function testDefaultIdIsNull(): void
    {
        self::assertNull(new GithubRepo()->getId());
    }

    /**
     * @return void
     */
    public function testDefaultOwnerIsNull(): void
    {
        self::assertNull(new GithubRepo()->getOwner());
    }

    /**
     * @return void
     */
    public function testDefaultProjectIsNull(): void
    {
        self::assertNull(new GithubRepo()->getProject());
    }

    /**
     * @return void
     */
    public function testDefaultUsersIsEmpty(): void
    {
        self::assertEmpty(new GithubRepo()->getUsers());
    }

    /**
     * @return void
     */
    public function testSetOwner(): void
    {
        $repo = new GithubRepo();
        $repo->setOwner('foo');
        self::assertSame('foo', $repo->getOwner());
    }

    /**
     * @return void
     */
    public function testSetProject(): void
    {
        $repo = new GithubRepo();
        $repo->setProject('bar');
        self::assertSame('bar', $repo->getProject());
    }

    /**
     * @return void
     */
    public function testAddUser(): void
    {
        $repo = new GithubRepo();
        $user = new User();
        $repo->addUser($user);
        self::assertCount(1, $repo->getUsers());
        self::assertCount(1, $user->getGithubRepos());
        self::assertSame($user, $repo->getUsers()->first());
        self::assertSame($repo, $user->getGithubRepos()->first());
    }

    /**
     * @return void
     */
    public function testRemoveUser(): void
    {
        $repo = new GithubRepo();
        $user1 = new User();
        $user2 = new User();
        $repo->addUser($user1);
        $repo->addUser($user2);
        self::assertCount(2, $repo->getUsers());
        $repo->removeUser($user1);
        self::assertCount(1, $repo->getUsers());
        self::assertSame($user2, $repo->getUsers()->first());
    }

    /**
     * @return void
     */
    public function testToString(): void
    {
        $repo = new GithubRepo();
        self::assertSame('/', (string) $repo);
        $repo->setOwner('foo');
        self::assertSame('foo/', (string) $repo);
        $repo->setProject('bar');
        self::assertSame('foo/bar', (string) $repo);
    }
}
