<?php

declare(strict_types=1);

namespace Faker\Provider\ar_EG;

use Faker\Test\TestCase;

/**
 * @group legacy
 */
final class PhoneNumberTest extends TestCase
{
    public function testPhoneNumber(): void
    {
        self::assertMatchesRegularExpression('/^(\+20\s?)?(\d{1,2})\s?\d{3,4}\s?\d{4}$|^(\+20\s?)?(\d{1,2})\d{7}$/', $this->faker->phoneNumber());
    }

    public function testMobileNumber(): void
    {
        // Local format: 0XX XXXX XXXX (with leading 0)
        // International format: +20 XX XXXX XXXX (without leading 0)
        self::assertMatchesRegularExpression('/^(\+20\s?)?(0?1[0125])\s?\d{3,4}\s?\d{4}$|^(\+20\s?)?(0?1[0125])\d{8}$/', $this->faker->mobileNumber());
    }

    protected function getProviders(): iterable
    {
        yield new PhoneNumber($this->faker);
    }
}
