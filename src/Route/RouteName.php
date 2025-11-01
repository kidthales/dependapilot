<?php

/*
 * (c) Tristan Bonsor <tristan@agogpixel.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\Route;

/**
 * @author kidthales <kidthales@agogpixel.com>
 */
final readonly class RouteName
{
    /**
     * Dashboard route name.
     */
    public const string DASHBOARD = 'app_dashboard';

    /**
     * Login route name.
     */
    public const string LOGIN = 'app_login';

    /**
     * Connect route name.
     */
    public const string CONNECT = 'app_connect';

    /**
     * Connect check route name.
     */
    public const string CONNECT_CHECK = 'app_connect_check';

    /**
     *
     */
    private function __construct()
    {
    }
}
