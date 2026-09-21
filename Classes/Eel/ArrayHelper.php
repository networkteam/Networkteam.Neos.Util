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
     * @param mixed $array1
     * @param mixed $array2
     * @return bool|null
     */
    public function hasElementIntersection($array1, $array2): ?bool
    {

        if (!is_iterable($array1) || !is_iterable($array2)) {
            return null;
        }

        $array2 = is_array($array2) ? $array2 : iterator_to_array($array2);

        foreach ($array1 as $elem1) {
            if (in_array($elem1, $array2, true)) {
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
