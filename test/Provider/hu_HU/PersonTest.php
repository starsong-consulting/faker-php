<?php

declare(strict_types=1);

namespace Faker\Test\Provider\hu_HU;

use Faker\Provider\hu_HU\Person;
use Faker\Test\TestCase;

/**
 * @group legacy
 */
final class PersonTest extends TestCase
{
    public function testNameIsReproducible(): void
    {
        $this->faker->seed(1);
        $first = $this->faker->name('female');

        $this->faker->seed(1);
        $second = $this->faker->name('female');

        self::assertEquals($first, $second);
        self::assertNotEmpty($first);
    }

    public function testNameGeneratesValidNames(): void
    {
        $name = $this->faker->name('female');
        self::assertNotEmpty($name);
        self::assertIsString($name);
    }

    protected function getProviders(): iterable
    {
        yield new Person($this->faker);
    }
}
