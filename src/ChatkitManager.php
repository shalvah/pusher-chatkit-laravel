<?php

declare(strict_types=1);

namespace Chatkit\Laravel;

use Chatkit\Chatkit;
use GrahamCampbell\Manager\AbstractManager;
use Illuminate\Contracts\Config\Repository;

/**
 * Chatkit manager class. The purpose of using this class is to
 * allow us elegantly switch between different Chatkit connections
 *
 * @author Shalvah Adebayo <shalvah.adebayo@gmail.com>
 * @mixin Chatkit
 */
class ChatkitManager extends AbstractManager
{
    /**
     * The factory instance.
     *
     * @var ChatkitFactory
     */
    private $factory;

    /**
     * Create a new Chatkit manager instance.
     *
     * @param \Illuminate\Contracts\Config\Repository $config
     * @param ChatkitFactory $factory
     *
     * @return void
     */
    public function __construct(Repository $config, ChatkitFactory $factory)
    {
        parent::__construct($config);
        $this->factory = $factory;
    }

    /**
     * Create the connection instance.
     *
     * @param array $config
     *
     * @return Chatkit
     */
    protected function createConnection(array $config): Chatkit
    {
        return $this->factory->make($config);
    }

    /**
     * Get the key used to reference this package in app config.
     *
     * @return string
     */
    protected function getConfigName(): string
    {
        return 'chatkit';
    }

    public function getFactory(): ChatkitFactory
    {
        return $this->factory;
    }
}
