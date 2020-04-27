<?php


namespace app\helper;

use app\entity\Phone;

/**
 * Class PhoneNumberFormatter
 * @package app\helper
 */
class PhoneNumberFormatterHelper
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
        $phone = $phone->getPhone();
        $phone = str_split($phone);
        $format = str_split($this->format);
        $format = array_reverse($format);
        $result = [];

        while ($s = array_pop($format)) {
            if ('X' == $s) {
                $result[] = array_pop($phone);
            } else {
                $result[] = $s;
            }
        }

        $phone = join('', $result);
        return $phone;
    }
}
