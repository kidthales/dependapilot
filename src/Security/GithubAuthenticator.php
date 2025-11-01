<?php

/*
 * (c) Tristan Bonsor <tristan@agogpixel.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\Security;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Route\RouteName;
use Doctrine\ORM\EntityManagerInterface;
use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use KnpU\OAuth2ClientBundle\Security\Authenticator\OAuth2Authenticator;
use League\OAuth2\Client\Provider\GithubResourceOwner;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\Authenticator\Passport\SelfValidatingPassport;
use Throwable;

/**
 * @author kidthales <kidthales@agogpixel.com>
 */
final class GithubAuthenticator extends OAuth2Authenticator
{
    /**
     * @param ClientRegistry $registry
     * @param EntityManagerInterface $entityManager
     * @param RouterInterface $router
     */
    public function __construct(
        private readonly ClientRegistry         $registry,
        private readonly EntityManagerInterface $entityManager,
        private readonly RouterInterface        $router
    )
    {
    }

    /**
     * @inheritDoc
     */
    public function supports(Request $request): ?bool
    {
        return $request->attributes->get('_route') === RouteName::CONNECT_CHECK;
    }

    /**
     * @inheritDoc
     */
    public function authenticate(Request $request): Passport
    {
        $client = $this->registry->getClient('github');
        $accessToken = $this->fetchAccessToken($client);

        return new SelfValidatingPassport(
            new UserBadge($accessToken->getToken(), function () use ($accessToken, $client, $request) {
                try {
                    /** @var GithubResourceOwner $githubUser */
                    $githubResourceOwner = $client->fetchUserFromToken($accessToken);
                } catch (Throwable) {
                    return null;
                }

                $id = $githubResourceOwner->getId();
                if ($id === null) {
                    return null;
                }

                /** @var UserRepository $repository */
                $repository = $this->entityManager->getRepository(User::class);
                $user = $repository->findOneByGithubId($id);
                if ($user === null) {
                    $user = new User();
                    $user->setGithubId($id);
                    $this->entityManager->persist($user);
                    $this->entityManager->flush();
                }

                $session = $request->getSession();
                $session->set('access_token', $accessToken);

                return $user;
            })
        );
    }

    /**
     * @inheritDoc
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        $session = $request->getSession();

        $route = $session->get('_route', RouteName::DASHBOARD);
        $session->remove('_route');

        $routeParams = $session->get('_route_params', []);
        $session->remove('_route_params');

        return new RedirectResponse($this->router->generate($route, $routeParams));
    }

    /**
     * @inheritDoc
     */
    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {
        $message = strtr($exception->getMessageKey(), $exception->getMessageData());
        return new Response($message, Response::HTTP_FORBIDDEN);
    }
}
