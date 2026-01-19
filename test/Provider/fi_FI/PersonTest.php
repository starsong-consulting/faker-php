<?php

declare(strict_types=1);

namespace Faker\Test\Provider\fi_FI;

use Faker\Provider\DateTime;
use Faker\Provider\fi_FI\Person;
use Faker\Test\TestCase;

/**
 * @group legacy
 */
final class PersonTest extends TestCase
{
    public function testPersonalIdentityNumberIsReproducible(): void
    {
        $birthdate = \DateTime::createFromFormat('Y-m-d', '1999-12-31');

        $this->faker->seed(1);
        $first = $this->faker->personalIdentityNumber($birthdate);

        $this->faker->seed(1);
        $second = $this->faker->personalIdentityNumber($birthdate);

        self::assertEquals($first, $second);
        // Should match Finnish PIN format: DDMMYY-XXXC
        self::assertMatchesRegularExpression('/^[0-9]{6}[-+A][0-9]{3}[0-9ABCDEFHJKLMNPRSTUVWXY]$/', $first);
    }

    public function testPersonalIdentityNumberGeneratesCompliantNumbers(): void
    {
        if (strtotime('1800-01-01 00:00:00')) {
            $min = '1900';
            $max = '2099';

            for ($i = 0; $i < 10; ++$i) {
                $birthdate = $this->faker->dateTimeBetween('1800-01-01 00:00:00', '1899-12-31 23:59:59');
                $pin = $this->faker->personalIdentityNumber($birthdate, null, true);
                self::assertMatchesRegularExpression('/^[0-9]{6}\+[0-9]{3}[0-9ABCDEFHJKLMNPRSTUVWXY]$/', $pin);
            }
        } else { // timestamp limit for 32-bit computer
            $min = '1902';
            $max = '2037';
        }

        for ($i = 0; $i < 10; ++$i) {
            $birthdate = $this->faker->dateTimeBetween("$min-01-01 00:00:00", '1999-12-31 23:59:59');
            $pin = $this->faker->personalIdentityNumber($birthdate);
            self::assertMatchesRegularExpression('/^[0-9]{6}-[0-9]{3}[0-9ABCDEFHJKLMNPRSTUVWXY]$/', $pin);
        }

        for ($i = 0; $i < 10; ++$i) {
            $birthdate = $this->faker->dateTimeBetween('2000-01-01 00:00:00', "$max-12-31 23:59:59");
            $pin = $this->faker->personalIdentityNumber($birthdate);
            self::assertMatchesRegularExpression('/^[0-9]{6}A[0-9]{3}[0-9ABCDEFHJKLMNPRSTUVWXY]$/', $pin);
        }
    }

    public function testPersonalIdentityNumberGeneratesOddValuesForMales(): void
    {
        $pin = $this->faker->personalIdentityNumber(null, 'male');
        self::assertEquals(1, $pin[9] % 2);
    }

    public function testPersonalIdentityNumberGeneratesEvenValuesForFemales(): void
    {
        $pin = $this->faker->personalIdentityNumber(null, 'female');
        self::assertEquals(0, $pin[9] % 2);
    }

    protected function getProviders(): iterable
    {
        yield new Person($this->faker);

        yield new DateTime($this->faker);
    }
}
