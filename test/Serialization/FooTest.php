<?php

declare(strict_types=1);

namespace PlaygroundTest\Serialization;

use PHPUnit\Framework\TestCase;
use Playground\Serialization\Bar;
use Playground\Serialization\Baz;
use Playground\Serialization\Foo;

use function serialize;
use function unserialize;

class FooTest extends TestCase
{
    public function testSerializeAndUnserialize(): void
    {
        $foo        = new Foo(
            new Bar(
                new Baz(Baz::class)
            )
        );
        $serialized = serialize($foo);

        self::assertEquals($foo, unserialize($serialized));
    }
}
