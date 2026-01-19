<?php

declare(strict_types=1);

namespace Faker\Test\Provider\fr_FR;

use Faker\Provider\fr_FR\Address;
use Faker\Test\TestCase;

/**
 * @group legacy
 */
final class AddressTest extends TestCase
{
    public function testPostcode(): void
    {
        $postcode = $this->faker->postcode();
        self::assertNotEmpty($postcode);
        self::assertIsString($postcode);
        self::assertMatchesRegularExpression('@^\d{5}$@', $postcode);
    }

    public function testSecondaryAddressIsReproducible(): void
    {
        $this->faker->seed(1);
        $first1 = $this->faker->secondaryAddress();
        $first2 = $this->faker->secondaryAddress();

        $this->faker->seed(1);
        $second1 = $this->faker->secondaryAddress();
        $second2 = $this->faker->secondaryAddress();

        self::assertEquals($first1, $second1);
        self::assertEquals($first2, $second2);
        self::assertNotEmpty($first1);
    }

    public function testRegionIsReproducible(): void
    {
        $this->faker->seed(1);
        $first1 = $this->faker->region();
        $first2 = $this->faker->region();

        $this->faker->seed(1);
        $second1 = $this->faker->region();
        $second2 = $this->faker->region();

        self::assertEquals($first1, $second1);
        self::assertEquals($first2, $second2);
        self::assertNotEmpty($first1);
    }

    protected function getProviders(): iterable
    {
        yield new Address($this->faker);
    }
}
