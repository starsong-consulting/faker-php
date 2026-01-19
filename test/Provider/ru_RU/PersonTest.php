<?php

declare(strict_types=1);

namespace Faker\Test\Provider\ru_RU;

use Faker\Generator;
use Faker\Provider\ru_RU\Person;
use Faker\Test\TestCase;

/**
 * @group legacy
 */
final class PersonTest extends TestCase
{
    public function testLastNameForFemale(): void
    {
        self::assertEquals('а', substr($this->faker->lastName('female'), -2, 2));
    }

    public function testLastNameForMale(): void
    {
        self::assertNotEquals('а', substr($this->faker->lastName('male'), -2, 2));
    }

    public function testLastNameRandom(): void
    {
        self::assertNotNull($this->faker->lastName());
    }

    protected function getProviders(): iterable
    {
        yield new Person($this->faker);
    }

    public function testLastNameMaleIsReproducible(): void
    {
        $generator = new Generator();
        $generator->seed(42);
        $provider = new Person($generator);
        $first = $provider->lastNameMale();

        $generator->seed(42);
        $second = $provider->lastNameMale();

        self::assertEquals($first, $second);
        self::assertNotEmpty($first);
        // Male surnames don't end in 'а'
        self::assertNotEquals('а', substr($first, -2, 2));
    }

    public function testLastNameFemaleIsReproducible(): void
    {
        $generator = new Generator();
        $generator->seed(42);
        $provider = new Person($generator);
        $first = $provider->lastNameFemale();

        $generator->seed(42);
        $second = $provider->lastNameFemale();

        self::assertEquals($first, $second);
        self::assertNotEmpty($first);
        // Female surnames end in 'а'
        self::assertEquals('а', substr($first, -2, 2));
    }

    /**
     * Issue 832 - Female surnames should not have double 'а' at the end
     */
    public function testFemaleSurnameWithoutDoubleALetter(): void
    {
        $generator = new Generator();
        $generator->seed(55);

        foreach ($this->getProviders() as $provider) {
            $generator->addProvider($provider);
        }

        $name = $generator->name('female');

        // Name should be reproducible
        $generator->seed(55);
        $name2 = $generator->name('female');
        self::assertEquals($name, $name2);

        // And should not contain double 'а' at word boundaries
        self::assertDoesNotMatchRegularExpression('/аа /u', $name);
    }
}
