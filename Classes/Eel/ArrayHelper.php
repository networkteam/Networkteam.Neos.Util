<?php

namespace Networkteam\Neos\Util\Eel;

use Neos\Eel\ProtectedContextAwareInterface;

/**
 * Custom Array Helper
 */
class ArrayHelper implements ProtectedContextAwareInterface
{

    /**
     * Returns true if 2 arrays share at least one element, otherwise returns false
     * Returns null if any of the parameters is not an array.
     *
     * @param array $array1
     * @param array $array2
     * @return bool|null
     */
    public function hasElementIntersection($array1, $array2): ?bool
    {

        if (!is_iterable($array1) || !is_iterable($array2)) {
            return null;
        }

        $hasIntersection = false;
        foreach ($array1 as $elem1) {
            foreach ($array2 as $elem2) {
                if ($elem1 == $elem2) {
                    $hasIntersection = true;
                }
            }
        }
        return $hasIntersection;
    }

    public function allowsCallOfMethod($methodName)
    {
        return true;
    }
}
