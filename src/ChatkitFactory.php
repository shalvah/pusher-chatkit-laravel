<?php

declare(strict_types=1);

namespace Chatkit\Laravel;

use Chatkit\Chatkit;
use InvalidArgumentException;

/**
 * Utility class that helps us instantiate and setup Chatkit connections
 *
 * @author Shalvah Adebayo <shalvah.adebayo@gmail.com>
 */
class ChatkitFactory
{
    protected $configKeys = [
        'instance_locator',
        'key',
        'port',
        'timeout',
        'debug',
        'curl_options',
    ];

    /**
     * Make a new Chatkit client with a given configuration
     *
     * @param array $config
     *
     * @return Chatkit
     */
    public function make(array $config): Chatkit
    {
        $config = $this->extractConfig($config);
        return $this->createClient($config);
    }

    /**
     * Extract relevant configuration for creating a new Chatkit instance
     *
     * @param string[] $config
     *
     * @throws \InvalidArgumentException
     *
     * @return array
     */
    protected function extractConfig(array $config): array
    {
        foreach ($this->configKeys as $key) {
            if (!array_key_exists($key, $config)) {
                throw new InvalidArgumentException("Missing Chatkit configuration key [$key].");
            }
        }

        return array_only($config, $this->configKeys);
    }

    /**
     * Instantiate a new Chatkit client.
     *
     * @param string[] $config
     *
     * @return Chatkit
     */
    protected function createClient(array $config): Chatkit
    {
        return new Chatkit($config);
    }
}
