<?php

/*
 * (c) Tristan Bonsor <tristan@agogpixel.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\Repository;

use App\Entity\GithubRepo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<GithubRepo>
 * @author kidthales <kidthales@agogpixel.com>
 */
final class GithubRepoRepository extends ServiceEntityRepository
{
    /**
     * @param ManagerRegistry $registry
     * @codeCoverageIgnore
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GithubRepo::class);
    }
}
