<?php

/*
 * (c) Tristan Bonsor <tristan@agogpixel.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\Tests\Integration;

use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * @author kidthales <kidthales@agogpixel.com>
 */
abstract class DoctrineTestCase extends KernelTestCase
{
    /**
     * @var EntityManager|null
     */
    protected ?EntityManager $entityManager = null;

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
}
