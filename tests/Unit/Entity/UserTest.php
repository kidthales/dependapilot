<?php

/*
 * (c) Tristan Bonsor <tristan@agogpixel.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\Tests\Unit\Entity;

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
    public function testDefaultUserIdentifierIsEmptyString(): void
    {
        self::assertSame('', new User()->getUserIdentifier());
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
