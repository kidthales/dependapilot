<?php

/*
 * (c) Tristan Bonsor <tristan@agogpixel.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\Tests\Integration\Entity;

use App\Entity\User;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use PHPUnit\Framework\Attributes\CoversClass;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * @author kidthales <kidthales@agogpixel.com>
 */
#[CoversClass(User::class)]
final class UserTest extends KernelTestCase
{
    /**
     * @var EntityManager|null
     */
    private ?EntityManager $entityManager;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        $this->entityManager = self::bootKernel()
            ->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    /**
     * @return void
     */
    protected function tearDown(): void
    {
        parent::tearDown();
        // doing this is recommended to avoid memory leaks
        $this->entityManager->close();
        $this->entityManager = null;
    }

    /**
     * @return void
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function testPersist(): void
    {
        $user = new User();
        $user->setGithubId(1);
        $this->entityManager->persist($user);
        $this->entityManager->flush();
        self::assertNotNull($user->getId());
        self::assertNotNull($user->getCreatedAt());
    }
}
