<?php

declare(strict_types=1);

namespace PlaygroundTest\Serialization;

use PHPUnit\Framework\TestCase;
use Playground\Serialization\Bar;
use Playground\Serialization\Baz;

use function serialize;
use function unserialize;

class BarTest extends TestCase
{
    public function testSerializeAndUnserialize(): void
    {
        $bar = new Bar(new Baz(Baz::class));

        $serialized = serialize($bar);

        self::assertEquals(new Bar(new Baz(Baz::class)), unserialize($serialized));
    }
}
