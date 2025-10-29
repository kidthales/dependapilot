<?php

/*
 * (c) Tristan Bonsor <tristan@agogpixel.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<User>
 * @author kidthales <kidthales@agogpixel.com>
 */
final class UserRepository extends ServiceEntityRepository
{
    /**
     * @param ManagerRegistry $registry
     * @codeCoverageIgnore
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * @param int|string $value
     * @return User|null
     */
    public function findOneByGithubId(int|string $value): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.githubId = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
