<?php

/*
 * (c) Tristan Bonsor <tristan@agogpixel.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\Tests\Integration\Repository;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Tests\Integration\DoctrineTestCase;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use PHPUnit\Framework\Attributes\CoversClass;

/**
 * @author kidthales <kidthales@agogpixel.com>
 */
#[CoversClass(UserRepository::class)]
final class UserRepositoryTest extends DoctrineTestCase
{
    /**
     * @return void
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function testFindOneByGithubId(): void
    {
        $expected = new User();
        $expected->setGithubId(1);
        $this->entityManager->persist($expected);
        $this->entityManager->flush();
        /** @var UserRepository $subject */
        $subject = $this->entityManager->getRepository(User::class);
        $actual = $subject->findOneByGithubId(1);
        self::assertSame($expected, $actual);
        $actual = $subject->findOneByGithubId('11');
        self::assertNull($actual);
    }
}
