<?php

declare(strict_types=1);

namespace Chatkit\Tests\Laravel;

use Chatkit\Laravel\Facades\Chatkit as ChatkitFacade;

/**
 * Class PackageTest
 * Tests that the different parts of the package work as expected in a Laravel app
 */
class PackageTest extends BasePackageTest
{
    public function test_manager_proxies_calls_to_chatkit_client()
    {
        $this->manager->getConfig()->shouldReceive('get')->once()
            ->with('chatkit.default')->andReturn('chatkit');
        $this->chatkit->shouldReceive('createUser')->withArgs(['id', 'Full Name'])->once();
        $this->manager->createUser('id', 'Full Name');
    }

    public function test_facade_proxies_calls_to_chatkit_client()
    {
        $this->manager->getConfig()->shouldReceive('get')->once()
            ->with('chatkit.default')->andReturn('chatkit');
        $this->chatkit->shouldReceive('createUser')->withArgs(['id', 'Full Name'])->once();
        ChatkitFacade::createUser('id', 'Full Name');
    }

}
