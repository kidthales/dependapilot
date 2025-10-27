<?php

/*
 * (c) Tristan Bonsor <tristan@agogpixel.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\Entity\Trait;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ensure consuming class has `#[\Doctrine\ORM\Mapping\HasLifecycleCallbacks]` attribute.
 *
 * @author kidthales <kidthales@agogpixel.com>
 */
trait CreatedAtTrait
{
    /**
     * @var int|string|null
     */
    #[ORM\Column(name: 'created_at', type: 'bigint', nullable: false, updatable: false)]
    private int|string|null $createdAt = null;

    /**
     * @return int|string|null
     */
    public function getCreatedAt(): int|string|null
    {
        return $this->createdAt;
    }

    /**
     * @return void
     */
    #[ORM\PrePersist]
    public function prePersistCreatedAt(): void
    {
        $this->createdAt = time();
    }
}
