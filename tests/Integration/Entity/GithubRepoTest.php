<?php

/*
 * (c) Tristan Bonsor <tristan@agogpixel.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\Tests\Integration\Entity;

use App\Entity\GithubRepo;
use App\Tests\Integration\DoctrineTestCase;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use PHPUnit\Framework\Attributes\CoversClass;

/**
 * @author kidthales <kidthales@agogpixel.com>
 */
#[CoversClass(GithubRepo::class)]
final class GithubRepoTest extends DoctrineTestCase
{
    /**
     * @return void
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function testPersist(): void
    {
        $repo = new GithubRepo();
        $repo->setOwner('foo')
            ->setProject('bar');
        $this->entityManager->persist($repo);
        $this->entityManager->flush();
        self::assertNotNull($repo->getId());
    }
}
