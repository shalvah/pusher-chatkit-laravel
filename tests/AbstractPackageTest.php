<?php

declare(strict_types=1);

namespace Chatkit\Tests\Laravel;

use Illuminate\Contracts\Config\Repository;
use Mockery;
use Orchestra\Testbench\TestCase;
use Chatkit\Laravel\ChatkitFactory;
use Chatkit\Laravel\ChatkitManager;
use Chatkit\Chatkit;

class AbstractPackageTest extends TestCase
{
    protected $config = ['path' => __DIR__, 'name' => 'chatkit'];

    /**
     * @var ChatkitManager
     */
    protected $manager;

    /**
     * @var Mockery\Mock
     */
    protected $chatkit;

    protected function setUp()
    {
        parent::setUp();
        $this->chatkit = Mockery::mock(Chatkit::class);

        $configRepository = Mockery::mock(Repository::class);
        $factory = Mockery::mock(ChatkitFactory::class);

        $this->manager = new ChatkitManager($configRepository, $factory);

        $this->manager->getConfig()->shouldReceive('get')->once()
            ->with('chatkit.connections')->andReturn(['chatkit' => $this->config]);
        $this->manager->getFactory()->shouldReceive('make')->once()
            ->with($this->config)->andReturn($this->chatkit);
    }

    protected function getEnvironmentSetUp($app)
    {
        // bind our manager instance , so we can make assertions on it
        $app['chatkit'] = function () {
            return $this->manager;
        };
    }

    protected function getPackageAliases($app)
    {
        return [
            'Chatkit' => 'Chatkit\Laravel\Facades\Chatkit'
        ];
    }

    protected function getPackageProviders($app)
    {
        return [
            'Chatkit\Laravel\ChatkitServiceProvider'
        ];
    }
}
