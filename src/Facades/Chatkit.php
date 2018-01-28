<?php

declare(strict_types=1);

namespace Chatkit\Laravel\Facades;

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
