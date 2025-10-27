<?php

/*
 * (c) Tristan Bonsor <tristan@agogpixel.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\Entity;

use App\Entity\Trait\CreatedAtTrait;
use App\Entity\Trait\PrimaryIdTrait;
use App\Repository\UserRepository;
use Deprecated;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @author kidthales <kidthales@agogpixel.com>
 */
#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_GITHUB_ID', fields: ['githubId'])]
#[ORM\HasLifecycleCallbacks]
final class User implements UserInterface
{
    use PrimaryIdTrait, CreatedAtTrait;

    /**
     * @var int|string|null
     */
    #[ORM\Column(name: 'github_id', type: 'bigint', nullable: false, updatable: false)]
    private int|string|null $githubId = null;

    /**
     * @return int|string|null
     */
    public function getGithubId(): int|string|null
    {
        return $this->githubId;
    }

    /**
     * @param int|string $githubId
     * @return $this
     */
    public function setGithubId(int|string $githubId): static
    {
        $this->githubId = $githubId;
        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @return string
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string)$this->githubId;
    }

    /**
     * @return string[]
     * @see UserInterface
     */
    public function getRoles(): array
    {
        return ['ROLE_USER'];
    }

    /**
     * @return void
     * @codeCoverageIgnore
     * @deprecated
     */
    #[Deprecated]
    public function eraseCredentials(): void
    {
        // @deprecated, to be removed when upgrading to Symfony 8
    }
}
