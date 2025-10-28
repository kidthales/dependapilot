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
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

/**
 * @author kidthales <kidthales@agogpixel.com>
 */
#[CoversClass(GithubRepo::class)]
final class GithubRepoTest extends TestCase
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
