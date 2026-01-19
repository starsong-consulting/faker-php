<?php

namespace Faker\Provider\en_LK;

class PhoneNumber extends \Faker\Provider\PhoneNumber
{
    /**
     * Sri Lankan mobile phone formats
     *
     * Mobile prefixes: 071, 072, 074, 075, 076, 077, 078, 079
     *
     * @see https://en.wikipedia.org/wiki/Telephone_numbers_in_Sri_Lanka
     */
    protected static $formats = [
        // National format
        '071 ### ####',
        '072 ### ####',
        '074 ### ####',
        '075 ### ####',
        '076 ### ####',
        '077 ### ####',
        '078 ### ####',
        '079 ### ####',
    ];

    protected static $mobileFormats = [
        // International E.164 format
        '+94 71 ### ####',
        '+94 72 ### ####',
        '+94 74 ### ####',
        '+94 75 ### ####',
        '+94 76 ### ####',
        '+94 77 ### ####',
        '+94 78 ### ####',
        '+94 79 ### ####',
        // National format
        '071 ### ####',
        '072 ### ####',
        '074 ### ####',
        '075 ### ####',
        '076 ### ####',
        '077 ### ####',
        '078 ### ####',
        '079 ### ####',
    ];

    /**
     * Generate a Sri Lankan mobile phone number
     *
     * @example '+94 77 123 4567'
     */
    public static function mobileNumber()
    {
        return static::numerify(static::randomElement(static::$mobileFormats));
    }
}
