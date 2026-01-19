<?php

declare(strict_types=1);

namespace Faker\Test\Provider\ja_JP;

use Faker\Provider\ja_JP\Internet;
use Faker\Test\TestCase;

/**
 * @group legacy
 */
final class InternetTest extends TestCase
{
    public function testUserNameIsReproducible(): void
    {
        $this->faker->seed(1);
        $first = $this->faker->userName();

        $this->faker->seed(1);
        $second = $this->faker->userName();

        self::assertEquals($first, $second);
        self::assertMatchesRegularExpression('/^[a-z0-9._]+$/', $first);
    }

    public function testDomainNameIsReproducible(): void
    {
        $this->faker->seed(1);
        $first = $this->faker->domainName();

        $this->faker->seed(1);
        $second = $this->faker->domainName();

        self::assertEquals($first, $second);
        self::assertMatchesRegularExpression('/^[a-z]+\.[a-z]+$/', $first);
    }

    protected function getProviders(): iterable
    {
        yield new Internet($this->faker);
    }
}
