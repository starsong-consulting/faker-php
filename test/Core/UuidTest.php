<?php

declare(strict_types=1);

namespace Faker\Test\Core;

use Faker\Core\Number;
use Faker\Core\Uuid;
use Faker\Test\TestCase;

final class UuidTest extends TestCase
{
    public function testUuidReturnsUuid(): void
    {
        $instance = new Uuid(new Number());
        $uuid = $instance->uuid3();
        self::assertTrue($this->isUuid($uuid));
    }

    public function testUuidSeededIsReproducible(): void
    {
        $instance = new Uuid(new Number());

        $this->faker->seed(123);
        $first1 = $instance->uuid3();
        $first2 = $instance->uuid3();

        $this->faker->seed(123);
        $second1 = $instance->uuid3();
        $second2 = $instance->uuid3();

        self::assertEquals($first1, $second1);
        self::assertEquals($first2, $second2);
        self::assertNotEquals($first1, $first2);
    }

    protected function isUuid(string $uuid)
    {
        return is_string($uuid) && (bool) preg_match(
            '/^[a-f0-9]{8,8}-(?:[a-f0-9]{4,4}-){3,3}[a-f0-9]{12,12}$/i',
            $uuid,
        );
    }
}
