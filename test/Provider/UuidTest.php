<?php

declare(strict_types=1);

namespace Faker\Test\Provider;

use Faker\Provider\Uuid as BaseProvider;
use Faker\Test\TestCase;

/**
 * @group legacy
 */
final class UuidTest extends TestCase
{
    public function testUuidReturnsUuid(): void
    {
        $uuid = BaseProvider::uuid();
        self::assertTrue($this->isUuid($uuid));
    }

    public function testUuidSeededIsReproducible(): void
    {
        $this->faker->seed(123);
        $first1 = BaseProvider::uuid();
        $first2 = BaseProvider::uuid();

        $this->faker->seed(123);
        $second1 = BaseProvider::uuid();
        $second2 = BaseProvider::uuid();

        self::assertEquals($first1, $second1);
        self::assertEquals($first2, $second2);
        self::assertNotEquals($first1, $first2);
    }

    protected function isUuid($uuid)
    {
        return is_string($uuid) && (bool) preg_match('/^[a-f0-9]{8,8}-(?:[a-f0-9]{4,4}-){3,3}[a-f0-9]{12,12}$/i', $uuid);
    }
}
