<?php

declare(strict_types=1);

namespace Faker\Test\Provider\ja_JP;

use Faker\Provider\ja_JP\Person;
use Faker\Test\TestCase;

/**
 * @group legacy
 */
final class PersonTest extends TestCase
{
    public function testKanaNameMaleIsReproducible(): void
    {
        $this->faker->seed(1);
        $first = $this->faker->kanaName('male');

        $this->faker->seed(1);
        $second = $this->faker->kanaName('male');

        self::assertEquals($first, $second);
        self::assertNotEmpty($first);
    }

    public function testKanaNameFemaleIsReproducible(): void
    {
        $this->faker->seed(1);
        $first = $this->faker->kanaName('female');

        $this->faker->seed(1);
        $second = $this->faker->kanaName('female');

        self::assertEquals($first, $second);
        self::assertNotEmpty($first);
    }

    public function testFirstKanaNameMaleIsReproducible(): void
    {
        $this->faker->seed(1);
        $first = $this->faker->firstKanaName('male');

        $this->faker->seed(1);
        $second = $this->faker->firstKanaName('male');

        self::assertEquals($first, $second);
        self::assertNotEmpty($first);
    }

    public function testFirstKanaNameFemaleIsReproducible(): void
    {
        $this->faker->seed(1);
        $first = $this->faker->firstKanaName('female');

        $this->faker->seed(1);
        $second = $this->faker->firstKanaName('female');

        self::assertEquals($first, $second);
        self::assertNotEmpty($first);
    }

    public function testLastKanaNameIsReproducible(): void
    {
        $this->faker->seed(1);
        $first = $this->faker->lastKanaName;

        $this->faker->seed(1);
        $second = $this->faker->lastKanaName;

        self::assertEquals($first, $second);
        self::assertNotEmpty($first);
    }

    protected function getProviders(): iterable
    {
        yield new Person($this->faker);
    }
}
