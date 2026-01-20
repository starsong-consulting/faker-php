<?php

declare(strict_types=1);

namespace Faker\Test\Provider\zh_TW;

use Faker\Provider\zh_TW\Address;
use Faker\Test\TestCase;

/**
 * @group legacy
 */
final class AddressTest extends TestCase
{
    public function testCounty(): void
    {
        $classRef = new \ReflectionClass(Address::class);
        $property = $classRef->getProperty('city');
        $city = array_keys($property->getValue());

        $county = $this->faker->county();

        self::assertContains($county, $city);
    }

    public function testDistOf(): void
    {
        $classRef = new \ReflectionClass(Address::class);
        $property = $classRef->getProperty('city');
        $city = $property->getValue();

        $county = $this->faker->county();
        $dist = $this->faker->distOf($county);

        self::assertContains($dist, $city[$county]);
    }

    public function testDist(): void
    {
        $classRef = new \ReflectionClass(Address::class);
        $property = $classRef->getProperty('city');
        $city = $property->getValue();

        $distSet = [];

        foreach ($city as $distList) {
            foreach ($distList as $distItem) {
                $distSet[] = $distItem;
            }
        }

        $dist = $this->faker->dist();

        self::assertContains($dist, $distSet);
    }

    protected function getProviders(): iterable
    {
        yield new Address($this->faker);
    }
}
