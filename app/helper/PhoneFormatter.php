<?php


namespace helper;

use app\entity\Phone;

/**
 * Class PhoneFormatter
 * @package helper
 */
class PhoneFormatter
{
    const DEFAULT_FORMAT = '8 XXX XX-XX';
    private string $format = self::DEFAULT_FORMAT;

    /**
     * PhoneFormat constructor.
     * @param string $format
     */
    public function __construct(string $format)
    {
        $this->format = $format;
    }

    /**
     * @param Phone $phone
     * @return string
     */
    public function format(Phone $phone): string
    {
        $phone = explode('', $phone->getPhone());
        return = preg_replace('/X/', array_map(fn($x): string => array_pop($phone)));
    }
}
