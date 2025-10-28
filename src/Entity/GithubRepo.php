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
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @var Collection
     */
    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'githubRepos')]
    private Collection $users;

    /**
     *
     */
    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

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
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    /**
     * @param User $user
     * @return $this
     */
    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->addGithubRepo($this); // Ensure bidirectional relationship
        }
        return $this;
    }

    /**
     * @param User $user
     * @return $this
     */
    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            $user->removeGithubRepo($this); // Ensure bidirectional relationship
        }
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
