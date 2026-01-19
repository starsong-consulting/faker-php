<?php

declare(strict_types=1);

namespace Faker\Test\Provider\uk_UA;

use Faker\Provider\uk_UA\Person;
use Faker\Test\TestCase;

/**
 * @group legacy
 */
final class PersonTest extends TestCase
{
    public function testFirstNameMaleIsReproducible(): void
    {
        $this->faker->seed(1);
        $first = $this->faker->firstNameMale();

        $this->faker->seed(1);
        $second = $this->faker->firstNameMale();

        self::assertEquals($first, $second);
        self::assertNotEmpty($first);
    }

    public function testFirstNameFemaleIsReproducible(): void
    {
        $this->faker->seed(1);
        $first = $this->faker->firstNameFemale();

        $this->faker->seed(1);
        $second = $this->faker->firstNameFemale();

        self::assertEquals($first, $second);
        self::assertNotEmpty($first);
    }

    public function testMiddleNameMaleIsReproducible(): void
    {
        $this->faker->seed(1);
        $first = $this->faker->middleNameMale();

        $this->faker->seed(1);
        $second = $this->faker->middleNameMale();

        self::assertEquals($first, $second);
        self::assertNotEmpty($first);
    }

    public function testMiddleNameFemaleIsReproducible(): void
    {
        $this->faker->seed(1);
        $first = $this->faker->middleNameFemale();

        $this->faker->seed(1);
        $second = $this->faker->middleNameFemale();

        self::assertEquals($first, $second);
        self::assertNotEmpty($first);
    }

    public function testLastNameIsReproducible(): void
    {
        $this->faker->seed(1);
        $first = $this->faker->lastName();

        $this->faker->seed(1);
        $second = $this->faker->lastName();

        self::assertEquals($first, $second);
        self::assertNotEmpty($first);
    }

    protected function getProviders(): iterable
    {
        yield new Person($this->faker);
    }
}
