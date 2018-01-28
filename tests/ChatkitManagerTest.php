<?php

declare(strict_types=1);

namespace Chatkit\Tests\Laravel;

use Chatkit\Chatkit;

class ChatkitManagerTest extends BasePackageTest
{
    public function test_manager_creates_connection_successfully()
    {
        $this->manager->getConfig()->shouldReceive('get')->once()
            ->with('chatkit.default')->andReturn('chatkit');

        $this->assertSame([], $this->manager->getConnections());

        $connection = $this->manager->connection();
        $this->assertInstanceOf(Chatkit::class, $connection);
        $this->assertSame($this->chatkit, $connection);

        $this->assertArrayHasKey('chatkit', $this->manager->getConnections());
    }
}
