<?php

declare(strict_types=1);

namespace Faker\Test\Provider\fr_FR;

use Faker\Provider\fr_FR\Color;
use Faker\Test\TestCase;

/**
 * @group legacy
 */
final class ColorTest extends TestCase
{
    public function testColorNameIsReproducible(): void
    {
        $this->faker->seed(1);
        $first1 = $this->faker->colorName();
        $first2 = $this->faker->colorName();

        $this->faker->seed(1);
        $second1 = $this->faker->colorName();
        $second2 = $this->faker->colorName();

        self::assertEquals($first1, $second1);
        self::assertEquals($first2, $second2);
        self::assertNotEmpty($first1);
    }

    public function testSafeColorNameIsReproducible(): void
    {
        $this->faker->seed(1);
        $first1 = $this->faker->safeColorName();
        $first2 = $this->faker->safeColorName();

        $this->faker->seed(1);
        $second1 = $this->faker->safeColorName();
        $second2 = $this->faker->safeColorName();

        self::assertEquals($first1, $second1);
        self::assertEquals($first2, $second2);
        self::assertNotEmpty($first1);
    }

    protected function getProviders(): iterable
    {
        yield new Color($this->faker);
    }
}
