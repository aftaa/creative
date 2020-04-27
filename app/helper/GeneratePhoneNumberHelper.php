<?php


namespace app\helper;

use app\entity\Person;
use app\entity\Phone;

/**
 * Class GeneratePhoneNumber
 * @package app\helper
 */
class GeneratePhoneNumberHelper
{
    const PREFIXES = [
        903, 905, 916, 926, 985, 983, 495, 499
    ];

    /**
     * @param Persons[] $persons
     * @return Persons[]
     * @throws \Exception
     */
    public function gen(array $persons): array
    {
        foreach ($persons as $person) {
            $numberCount = mt_rand(1, 3);

            while ($numberCount--) {
                $number = self::PREFIXES[array_rand(self::PREFIXES)];
                $number .= $this->random_number(7);

                $person->addPhone(
                    new Phone($number, 0)
                );
            }
        }
        return $persons;
    }

    /**
     * @copyright https://ruphp.com/32865.html
     *
     * @param int $length
     * @return string
     */
    private function random_number(int $length): string
    {
        return join('', array_map(function ($value) {
            return $value == 1 ? mt_rand(1, 9) : mt_rand(0, 9);
        }, range(1, $length)));
    }
}
