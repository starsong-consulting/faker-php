<?php

declare(strict_types=1);

namespace Faker\Test\Provider\en_LK;

use Faker\Provider\en_LK\Person;
use Faker\Test\TestCase;

final class PersonTest extends TestCase
{
    public function testNicNumberOld(): void
    {
        for ($i = 0; $i < 10; ++$i) {
            $nic = $this->faker->nicNumberOld();

            self::assertSame(10, strlen($nic), "Old NIC should be 10 characters: $nic");
            self::assertMatchesRegularExpression('/^\d{9}[VX]$/', $nic);
        }
    }

    public function testNicNumber(): void
    {
        for ($i = 0; $i < 10; ++$i) {
            $nic = $this->faker->nicNumber();

            self::assertSame(12, strlen($nic), "New NIC should be 12 characters: $nic");
            self::assertMatchesRegularExpression('/^\d{12}$/', $nic);

            $year = (int) substr($nic, 0, 4);
            self::assertGreaterThanOrEqual(1950, $year);
            self::assertLessThanOrEqual(2005, $year);
        }
    }

    public function testMaleName(): void
    {
        for ($i = 0; $i < 10; ++$i) {
            $name = $this->faker->name('male');

            self::assertNotEmpty($name);
        }
    }

    public function testFemaleName(): void
    {
        for ($i = 0; $i < 10; ++$i) {
            $name = $this->faker->name('female');

            self::assertNotEmpty($name);
        }
    }

    protected function getProviders(): iterable
    {
        yield new Person($this->faker);
    }
}
