<?php

/*
 * This file is part of Laravel Pusher.
 *
 * (c) Pusher, Ltd (https://pusher.com)
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Pusher\Chatkit\Laravel\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Chatkit facade. For easy static calls to the Chatkit manager
 *
 * @author Shalvah Adebayo <shalvah.adebayo@gmail.com>
 */
class Chatkit extends Facade
{
    /**
     * Get the key of the component in the DI container the Facade proxies to
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'chatkit';
    }
}
