<?php

declare(strict_types=1);

namespace Faker\Test\Provider\en_LK;

use Faker\Provider\en_LK\PhoneNumber;
use Faker\Test\TestCase;

final class PhoneNumberTest extends TestCase
{
    public function testMobileNumber(): void
    {
        for ($i = 0; $i < 10; ++$i) {
            $number = $this->faker->mobileNumber();

            // Remove all non-digits
            $digits = preg_replace('/\D/', '', $number);

            // International format has 11 digits (94 + 9 digits)
            // National format has 10 digits
            self::assertTrue(
                strlen($digits) === 10 || strlen($digits) === 11,
                "Phone number should have 10 or 11 digits: $number (has " . strlen($digits) . ')',
            );

            // Check for valid mobile prefix
            if (strlen($digits) === 11) {
                // International: starts with 947X
                self::assertMatchesRegularExpression('/^947[124-9]/', $digits, "Invalid international prefix: $number");
            } else {
                // National: starts with 07X
                self::assertMatchesRegularExpression('/^07[124-9]/', $digits, "Invalid national prefix: $number");
            }
        }
    }

    public function testPhoneNumber(): void
    {
        for ($i = 0; $i < 10; ++$i) {
            $number = $this->faker->phoneNumber();

            self::assertNotEmpty($number);
        }
    }

    protected function getProviders(): iterable
    {
        yield new PhoneNumber($this->faker);
    }
}
