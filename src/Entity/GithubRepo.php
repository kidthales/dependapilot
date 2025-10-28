<?php

/*
 * (c) Tristan Bonsor <tristan@agogpixel.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\Entity;

use App\Entity\Trait\PrimaryIdTrait;
use App\Repository\GithubRepoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @author kidthales <kidthales@agogpixel.com>
 */
#[ORM\Entity(repositoryClass: GithubRepoRepository::class)]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_OWNER_PROJECT', fields: ['owner', 'project'])]
#[ORM\HasLifecycleCallbacks]
final class GithubRepo
{
    use PrimaryIdTrait;

    /**
     * @var string|null
     */
    #[ORM\Column(name: 'owner', type: 'string', length: 39, nullable: false, updatable: false)]
    private ?string $owner = null;

    /**
     * @var string|null
     */
    #[ORM\Column(name: 'project', type: 'string', length: 100, nullable: false, updatable: false)]
    private ?string $project = null;

    /**
     * @return string|null
     */
    public function getOwner(): string|null
    {
        return $this->owner;
    }

    /**
     * @param string $owner
     * @return $this
     */
    public function setOwner(string $owner): self
    {
        $this->owner = $owner;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getProject(): string|null
    {
        return $this->project;
    }

    /**
     * @param string $project
     * @return $this
     */
    public function setProject(string $project): self
    {
        $this->project = $project;
        return $this;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->owner . '/' . $this->project;
    }
}
