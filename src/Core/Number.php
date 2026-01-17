<?php

declare(strict_types=1);

namespace Faker\Core;

use Faker\Extension;
use Faker\Generator;

/**
 * @experimental This class is experimental and does not fall under our BC promise
 */
final class Number implements Extension\NumberExtension, Extension\GeneratorAwareExtension
{
    private ?Generator $generator = null;

    public function withGenerator(Generator $generator): Extension\Extension
    {
        $instance = clone $this;
        $instance->generator = $generator;

        return $instance;
    }

    public function numberBetween(int $min = 0, int $max = 2147483647): int
    {
        $int1 = min($min, $max);
        $int2 = max($min, $max);

        // Use Generator's instance-level random when available (PHP 8.2+)
        if ($this->generator !== null) {
            return $this->generator->randomInt($int1, $int2);
        }

        return Extension\Helper::randomNumberBetween($int1, $int2);
    }

    public function randomDigit(): int
    {
        return $this->numberBetween(0, 9);
    }

    public function randomDigitNot(int $except): int
    {
        $result = $this->numberBetween(0, 8);

        if ($result >= $except) {
            ++$result;
        }

        return $result;
    }

    public function randomDigitNotZero(): int
    {
        return $this->numberBetween(1, 9);
    }

    public function randomFloat(?int $nbMaxDecimals = null, float $min = 0, ?float $max = null): float
    {
        if (null === $nbMaxDecimals) {
            $nbMaxDecimals = $this->randomDigit();
        }

        if (null === $max) {
            $max = $this->randomNumber();

            if ($min > $max) {
                $max = $min;
            }
        }

        if ($min > $max) {
            $tmp = $min;
            $min = $max;
            $max = $tmp;
        }

        // Use consistent max value for float calculation
        $randMax = 2147483647;

        return round($min + $this->numberBetween(0, $randMax) / $randMax * ($max - $min), $nbMaxDecimals);
    }

    public function randomNumber(?int $nbDigits = null, bool $strict = false): int
    {
        if (null === $nbDigits) {
            $nbDigits = $this->randomDigitNotZero();
        }
        $max = 10 ** $nbDigits - 1;

        if ($max > Extension\Helper::largestRandomNumber()) {
            throw new \InvalidArgumentException('randomNumber() can only generate numbers up to mt_getrandmax()');
        }

        if ($strict) {
            return $this->numberBetween(10 ** ($nbDigits - 1), $max);
        }

        return $this->numberBetween(0, $max);
    }
}
