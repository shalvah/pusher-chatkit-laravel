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

return [

    /*
    |--------------------------------------------------------------------------
    | Default Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the connections below you wish to use as
    | your default connection for all work. Of course, you may use many
    | connections at once using the manager class.
    |
    */

    'default' => 'main',

    /*
    |--------------------------------------------------------------------------
    | Chatkit Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the connections setup for your application. Example
    | configuration has been included, but you may add as many connections as
    | you would like.
    |
    */

    'connections' => [

        'main' => [
            /**
             * Your Chatkit instance locator. Get this from your Chatkit app dashboard
             */
            'instance_locator' => env('CHATKIT_INSTANCE_LOCATOR'),

            /**
             * Your Chatkit instance locator. Get this from your Chatkit app dashboard
             */
            'key' => env('CHATKIT_KEY'),

            'port' => 80,

            'timeout' => 30,

            'debug' => false,

            'curl_options' => [],
        ],

        'alternative' => [

            'instance_locator' => 'your-instance-locator',

            'key' => 'your-auth-key',

            'port' => 80,

            'timeout' => 30,

            'debug' => false,

            'curl_options' => [],
        ],

    ],

];
