<?php

/*
 * (c) Tristan Bonsor <tristan@agogpixel.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\Controller;

use App\Route\RouteName;
use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use Symfony\Bridge\Twig\Attribute\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

/**
 * @author kidthales <kidthales@agogpixel.com>
 */
final class AppController extends AbstractController
{
    /**
     * @return array
     */
    #[Route('/', name: RouteName::DASHBOARD)]
    #[Template(template: 'dashboard.html.twig')]
    public function index(): array
    {
        return [];
    }

    /**
     * @param Security $security
     * @return RedirectResponse|Response
     */
    #[Route('/login', name: RouteName::LOGIN)]
    public function login(Security $security): RedirectResponse|Response
    {
        return $security->getUser()
            ? $this->redirectToRoute(RouteName::DASHBOARD)
            : $this->render('login.html.twig');
    }

    /**
     * @param ClientRegistry $registry
     * @return RedirectResponse
     */
    #[Route('/connect', name: RouteName::CONNECT)]
    public function connect(ClientRegistry $registry): RedirectResponse
    {
        // https://docs.github.com/en/apps/oauth-apps/building-oauth-apps/scopes-for-oauth-apps#available-scopes
        return $registry->getClient('github')->redirect(scopes: ['repo']);
    }

    /**
     * @return void
     * @codeCoverageIgnore
     */
    #[Route('/connect/check', name: RouteName::CONNECT_CHECK)]
    public function connectCheck(): void
    {
    }
}
