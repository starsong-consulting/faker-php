<?php

declare(strict_types=1);

namespace Faker\Test\Provider\sv_SE;

use Faker\Calculator\Luhn;
use Faker\Provider\sv_SE\Person;
use Faker\Test\TestCase;

/**
 * @group legacy
 */
final class PersonTest extends TestCase
{
    public function testPersonalIdentityNumberIsReproducible(): void
    {
        $birthdate = \DateTime::createFromFormat('ymd', '720727');

        $this->faker->seed(1);
        $first = $this->faker->personalIdentityNumber($birthdate);

        $this->faker->seed(1);
        $second = $this->faker->personalIdentityNumber($birthdate);

        self::assertEquals($first, $second);
        // Should match Swedish PIN format: YYMMDD-XXXX
        self::assertMatchesRegularExpression('/^[0-9]{6}-[0-9]{4}$/', $first);
    }

    public function testPersonalIdentityNumberGeneratesLuhnCompliantNumbers(): void
    {
        $pin = str_replace('-', '', $this->faker->personalIdentityNumber());
        self::assertTrue(Luhn::isValid($pin));
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

    public function testBirthNumberNot000(): void
    {
        $faker = $this->faker;
        $faker->seed(97270);
        $pin = $this->faker->personalIdentityNumber();

        self::assertNotEquals('000', substr($pin, 7, 3));
    }

    public function testBirthNumberGeneratesEvenValuesForFemales(): void
    {
        $faker = $this->faker;
        $faker->seed(372920);
        $pin = $this->faker->personalIdentityNumber(null, 'female');

        self::assertNotEquals('000', substr($pin, 7, 3));
    }

    protected function getProviders(): iterable
    {
        yield new Person($this->faker);
    }
}
