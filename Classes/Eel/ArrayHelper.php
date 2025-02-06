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

        foreach ($array1 as $elem1) {
            if (in_array($elem1, $array2, true)){
                return true;
            }
        }
        return false;
    }

    public function allowsCallOfMethod($methodName)
    {
        return true;
    }
}
