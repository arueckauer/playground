<?php

declare(strict_types=1);

namespace PlaygroundTest\Serialization;

use PHPUnit\Framework\TestCase;
use Playground\Serialization\Baz;

use function serialize;
use function unserialize;

class BazTest extends TestCase
{
    public function testSerializeAndUnserialize(): void
    {
        $baz = new Baz(Baz::class);

        $serializedBaz = serialize($baz);

        self::assertEquals(new Baz(Baz::class), unserialize($serializedBaz));
    }
}
