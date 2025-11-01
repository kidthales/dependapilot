<?php

/*
 * (c) Tristan Bonsor <tristan@agogpixel.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\Security;

use App\Route\RouteName;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\EntryPoint\AuthenticationEntryPointInterface;

/**
 * @author kidthales <kidthales@agogpixel.com>
 */
final readonly class AuthenticationEntryPoint implements AuthenticationEntryPointInterface
{
    /**
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(private UrlGeneratorInterface $urlGenerator)
    {
    }

    /**
     * @inheritDoc
     */
    public function start(Request $request, ?AuthenticationException $authException = null): Response
    {
        $session = $request->getSession();
        $session->set('_route', $request->attributes->get('_route', RouteName::DASHBOARD));
        $session->set('_route_params', $request->attributes->get('_route_params', []));
        return new RedirectResponse($this->urlGenerator->generate(RouteName::LOGIN));
    }
}
